"use server";

import { prisma } from "@/lib/db";
import { signUpSchema } from "@/schemas/auth/sign-up.schema";
import bcrypt from "bcryptjs";
import { redirect } from "next/navigation";
import { flattenError } from "zod";

interface SignUpActionState {
  errors: {
    name?: string[];
    email?: string[];
    password?: string[];
    termsAccepted?: string[];
    _form?: string[];
  };
}

export async function signUpAction(
  _prevState: SignUpActionState,
  formData: FormData,
) {
  const result = signUpSchema.safeParse({
    name: formData.get("name") as string,
    email: formData.get("email") as string,
    password: formData.get("password") as string,
    termsAccepted:
      formData.get("termsAccepted") === "on" ||
      formData.get("termsAccepted") === "true",
  });

  if (!result.success)
    return { errors: flattenError(result.error).fieldErrors };

  try {
    const hashedPassword = await bcrypt.hash(result.data.password, 10);
    await prisma.user.create({
      data: {
        name: result.data.name,
        email: result.data.email,
        password: hashedPassword,
      },
    });
    redirect("/sign-in");

    // eslint-disable-next-line @typescript-eslint/no-explicit-any
  } catch (error: any) {
    if (error?.digest?.startsWith("NEXT_REDIRECT")) throw error;
    if (error?.code === "P2002")
      return { errors: { email: ["Email Already Registered"] } };

    return {
      errors: {
        _form: ["Registration failed, please try again"],
      },
    };
  }
}
