"use server";
import { prisma } from "@/lib/db";
import { createUserSchema } from "@/schemas/user/user-create.schema";
import bcrypt from "bcryptjs";
import { redirect } from "next/navigation";
import { flattenError } from "zod";

interface CreateUserActionState {
  errors: {
    name?: string[];
    email?: string[];
    password?: string[];
    _form?: string[];
  };
}

export async function createUserAction(
  _prevState: CreateUserActionState,
  formData: FormData,
) {
  const result = createUserSchema.safeParse({
    name: formData.get("name") as string,
    email: formData.get("email") as string,
    password: formData.get("password") as string,
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

    redirect("/users");
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
  } catch (error: any) {
    if (error?.digest?.startsWith("NEXT_REDIRECT")) throw error;

    if (error?.code === "P2002") {
      return {
        errors: {
          email: ["Email already registered"],
        },
      };
    }

    return {
      errors: {
        _form: ["Registration failed, please try again"],
      },
    };
  }
}
