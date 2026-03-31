import { redirect } from "next/navigation";
import { getCurrentUser } from "./session";

export async function authIsRequired() {
  const user = await getCurrentUser();
  return !user ? redirect("/sign-in") : user;
}

export async function authIsNotRequired() {
  const user = await getCurrentUser();
  if (user) return redirect("/dashboard");
}
