import z from "zod";

export const signInSchema = z.object({
  email: z.email("Email tidak valid"),
  password: z.string().min(6, "Password min 6 karakter"),
});

export type signInInput = z.infer<typeof signInSchema>;
