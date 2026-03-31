
import PageHeader from "@/components/common/page-header";
import Sidebar from "@/components/layouts/sidebar";
import UserCreateForm from "@/components/user/create";
import { authIsRequired } from "@/lib/auth/middleware";
import { Metadata } from "next";

export const metadata: Metadata = {
    title: 'Create User - FullStack Next.js',
    description: ''
}
export default async function CreateUserPage() {
    await authIsRequired()

    return (
        <div className="min-h-screen bg-zinc-100 ">
            <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6 sm:py-10">
                <div className="flex flex-col gap-6 lg:flex-row">
                    {/* Sidebar */}
                    <div className="lg:sticky lg:top-24 lg:self-start">
                        <Sidebar />
                    </div>

                    {/* Main Content */}
                    <main className="flex-1 rounded-3xl bg-white p-5 sm:p-8 shadow-sm">
                        {/* Page Header */}
                        <PageHeader
                            title="Users Management"
                            subtitle="List of all users"
                        />
                        <UserCreateForm />
                    </main>
                </div>
            </div>
        </div>
    );
};
