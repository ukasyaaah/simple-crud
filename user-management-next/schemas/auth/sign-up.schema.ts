import z from "zod";

export const signUpSchema = z.object({
  name: z.string().min(2, "Nama minimal 2 karakter"),
  email: z.email("Email tidak valid"),
  password: z.string().min(6, "Password minimal 6 karakter"),
  termsAccepted: z.literal(true, {
    message: "Kamu harus menyetujui Terms & Privacy Policy",
  }),
});
export type SignUpInput = z.infer<typeof signUpSchema>;
