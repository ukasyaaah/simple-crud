"use server";
import { prisma } from "@/lib/db";
import { updateUserSchema } from "@/schemas/user/user-update.schema";
import bcrypt from "bcryptjs";
import { redirect } from "next/navigation";
import { flattenError } from "zod/v4/core";

interface UpdateUserActionState {
  errors: {
    id?: string[];
    name?: string[];
    email?: string[];
    password?: string[];
    _form?: string[];
  };
}
export async function updateUserAction(
  prevState: UpdateUserActionState,
  formData: FormData,
) {
  const result = updateUserSchema.safeParse({
    id: formData.get("id") as string,
    name: formData.get("name") as string,
    email: formData.get("email") as string,
    password: formData.get("password") as string,
  });

  if (!result.success) {
    return { errors: flattenError(result.error).fieldErrors };
  }

  try {
    const data: {
      name: string;
      email: string;
      password?: string;
    } = {
      name: result.data.name,
      email: result.data.email,
    };

    if (result.data.password && result.data.password.length > 0) {
      const hashedPassword = await bcrypt.hash(result.data.password, 10);
      data.password = hashedPassword;
    }

    await prisma.user.update({
      where: { id: result.data.id },
      data,
    });

    redirect("/users");
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
  } catch (error: any) {
    if (error?.digest?.startsWith("NEXT_REDIRECT")) throw error;

    if (error?.code === "P2002") {
      return { errors: { email: ["Email already registered"] } };
    }

    if (error?.code === "P2025") {
      return { errors: { _form: ["User not found"] } };
    }

    return { errors: { _form: ["Update failed, please try again"] } };
  }
}
