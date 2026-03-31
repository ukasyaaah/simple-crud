"use server";

import { authIsRequired } from "@/lib/auth/middleware";
import { prisma } from "@/lib/db";
import { revalidatePath } from "next/cache";

export async function deleteUserAction(formData: FormData) {
  await authIsRequired();

  const id = formData.get("id") as string;

  try {
    await prisma.user.delete({
      where: { id: id },
    });

    // eslint-disable-next-line @typescript-eslint/no-explicit-any
  } catch (error: any) {
    if (error?.code === "P2025") {
      revalidatePath("/users");
      return;
    }

    throw new Error("Gagal menghapus user, Silahkan mencoba lagi");
  }

  revalidatePath('/users')
}
