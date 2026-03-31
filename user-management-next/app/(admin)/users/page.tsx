import PageHeader from "@/components/common/page-header";
import Sidebar from "@/components/layouts/sidebar";
import UserTable from "@/components/user/table";
import { authIsRequired } from "@/lib/auth/middleware";
import { prisma } from "@/lib/db";
import { Metadata } from "next";
import Link from "next/link";

export const metadata: Metadata = {
    title: 'Users Management - FullStack Next.js',
    description: ''
}

export default async function UsersPage() {
    await authIsRequired()

    const users = await prisma.user.findMany({
        orderBy: {
            createdAt: 'desc'
        }
    })

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
                            action={
                                <Link
                                    href="/users/create"
                                    className="rounded-full bg-zinc-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-zinc-800"
                                >
                                    Add User
                                </Link>
                            }
                        />

                        {/* Table */}
                        <UserTable users={users} />
                    </main>
                </div>
            </div>
        </div>
    );
};
