import { SignInForm } from "@/components/auth/sign-in"
import { authIsNotRequired } from "@/lib/auth/middleware"
import { Metadata } from "next"

export const metadata: Metadata = {
    title: 'Sign In - FullStack Next.js',
    description: 'Sign in to your account',
}
export default async function SignInPage() {
    await authIsNotRequired()
    return <SignInForm />
}