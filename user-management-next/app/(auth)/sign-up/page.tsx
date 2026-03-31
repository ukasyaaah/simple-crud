import SignUpForm from "@/components/auth/sign-up";
import { authIsNotRequired } from "@/lib/auth/middleware";
import { Metadata } from "next";

export const metadata: Metadata = {
    title: 'Sign Up - FullStack Next.js',
    description: 'Create an account in seconds',
};

export default async function SignUpPage() {

    //jika user sudah login, redirect ke halaman dashboard
    await authIsNotRequired();

    return <SignUpForm />;
}