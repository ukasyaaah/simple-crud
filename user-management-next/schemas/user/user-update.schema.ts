import z from "zod";

export const updateUserSchema = z.object({
  id: z.string().cuid("ID user tidak valid"),
  name: z.string().min(2, "Nama min 2 karakter"),
  email: z.email("Email tidak valid"),
  password: z
    .string()
    .optional()
    .or(z.literal(""))
    .refine((r) => !r || r.length >= 6, "Password min 6 karakter"),
});

export type UpdateUserInput = z.infer<typeof updateUserSchema>;
