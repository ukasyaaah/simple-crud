"use server";
import { createSession } from "@/lib/auth/session";
import { prisma } from "@/lib/db";
import { signInSchema } from "@/schemas/auth/sign-in.schema";
import bcrypt from "bcryptjs";
import { redirect } from "next/navigation";

import { flattenError } from "zod";

interface SignInActionState {
  errors: {
    email?: string[];
    password?: string[];
    _form?: string[];
  };
}

export async function signInAction(
  _prevState: SignInActionState,
  formData: FormData,
) {
  const result = signInSchema.safeParse({
    email: formData.get("email") as string,
    password: formData.get("password") as string,
  });

  if (!result.success) {
    return { errors: flattenError(result.error).fieldErrors };
  }

  const user = await prisma.user.findUnique({
    where: { email: result.data.email },
  });

  if (!user || !(await bcrypt.compare(result.data.password, user.password))) {
    return {
      errors: {
        _form: ["Email atau Password salah!"],
      },
    };
  }

  await createSession(user.id);
  return redirect("/dashboard");
}
