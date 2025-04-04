<template>
    <AuthenticatedLayout>

        <div class="py-12">

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h2 class="text-xl font-semibold mb-6">Account Management</h2>


                    <UseTemplate>
                        <form @submit.prevent="submitForm" class="grid gap-4 px-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex flex-col gap-2 col-span-2">
                                    <Label for="name">Name</Label>
                                    <Input id="name" type="text" v-model="form.name" />
                                    <p v-if="form.errors?.name" class="text-red-500 text-sm">{{ form.errors.name }}
                                    </p>
                                </div>

                                <div class="flex flex-col gap-2 col-span-2">
                                    <Label for="email">Email</Label>
                                    <Input id="email" type="email" v-model="form.email" />
                                    <p v-if="form.errors?.email" class="text-red-500 text-sm">{{ form.errors.email
                                    }}</p>
                                </div>

                                <div class="flex flex-col gap-2 col-span-2">
                                    <Label for="password">Password</Label>
                                    <div class="relative">
                                        <Input id="password" :type="showPassword ? 'text' : 'password'"
                                            v-model="form.password"
                                            :placeholder="form.id ? 'Leave blank to keep current password' : ''"
                                            class="pr-10" />
                                        <span @click="togglePassword"
                                            class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500 hover:text-gray-700">
                                            <svg v-if="showPassword" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3.98 8.5a9.457 9.457 0 0116.04 0M21 12s-3 5-9 5-9-5-9-5m9 5c4.418 0 8-2.686 8-6s-3.582-6-8-6-8 2.686-8 6 3.582 6 8 6z" />
                                            </svg>
                                            <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 3l18 18m-1.5-1.5A9.457 9.457 0 0112 19.5c-4.418 0-8-2.686-8-6s3.582-6 8-6c1.444 0 2.8.342 4 .948M15.5 10c.758 0 1.493.177 2.166.496M9 15l6-6m-3 6V9" />
                                            </svg>
                                        </span>
                                    </div>
                                    <p v-if="form.errors?.password" class="text-red-500 text-sm">{{
                                        form.errors.password }}</p>
                                </div>
                            </div>

                            <div class="flex justify-end pt-2 gap-2">
                                <Button type="button" variant="outline" @click="isModalOpen = false">Cancel</Button>
                                <Button type="submit">Save</Button>
                            </div>
                        </form>
                    </UseTemplate>

                    <!-- Dialog for Desktop -->
                    <Dialog v-if="isDesktop" v-model:open="isModalOpen">
                        <DialogTrigger as-child>
                            <Button @click="openModal()">+ Add Account</Button>
                        </DialogTrigger>
                        <DialogContent class="sm:max-w-[500px]">
                            <DialogHeader>
                                <DialogTitle>{{ form.id ? 'Edit Account' : 'Add Account' }}</DialogTitle>
                                <DialogDescription>
                                    Enter account details and save changes.
                                </DialogDescription>
                            </DialogHeader>
                            <GridForm />
                        </DialogContent>
                    </Dialog>

                    <!-- Drawer for Mobile -->
                    <Drawer v-else v-model:open="isModalOpen">
                        <DrawerTrigger as-child>
                            <Button variant="outline">+ Add Account</Button>
                        </DrawerTrigger>
                        <DrawerContent>
                            <DrawerHeader class="text-left">
                                <DrawerTitle>{{ form.id ? 'Edit Account' : 'Add Account' }}</DrawerTitle>
                                <DrawerDescription>
                                    Enter account details and save changes.
                                </DrawerDescription>
                            </DrawerHeader>
                            <GridForm />
                            <DrawerFooter class="pt-2">
                                <DrawerClose as-child>
                                    <Button variant="outline">Cancel</Button>
                                </DrawerClose>
                            </DrawerFooter>
                        </DrawerContent>
                    </Drawer>


                    <!-- Accounts Table -->
                    <div class="overflow-x-auto mt-4 border rounded-lg mt-">
                        <Table>
                            <TableHeader class="bg-green-100">
                                <TableRow>
                                    <TableHead>ID</TableHead>
                                    <TableHead>Name</TableHead>
                                    <TableHead>Email</TableHead>
                                    <TableHead>Actions</TableHead>
                                </TableRow>
                            </TableHeader>

                            <TableBody>
                                <TableRow v-for="account in accounts" :key="account.id">
                                    <TableCell>{{ account.id }}</TableCell>
                                    <TableCell>{{ account.name }}</TableCell>
                                    <TableCell>{{ account.email }}</TableCell>
                                    <TableCell class="text-center">
                                        <DropdownMenu>
                                            <DropdownMenuTrigger as-child>
                                                <Button variant="ghost"
                                                    class="flex h-8 w-8 p-0 data-[state=open]:bg-muted">
                                                    <i class="fa-solid fa-ellipsis"></i>
                                                    <span class="sr-only">Open menu</span>
                                                </Button>
                                            </DropdownMenuTrigger>
                                            <DropdownMenuContent align="end" class="w-[160px]">
                                                <DropdownMenuItem @click="openModal(account)">
                                                    <i class="fa-solid fa-pen-to-square mr-2"></i> Edit
                                                </DropdownMenuItem>
                                                <DropdownMenuItem
                                                    v-if="$page.props.auth.user.email === 'test@gmail.com'"
                                                    @click="deleteAccount(account.id)">
                                                    <i class="fa-solid fa-trash mr-2"></i> Delete
                                                </DropdownMenuItem>
                                            </DropdownMenuContent>
                                        </DropdownMenu>
                                    </TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                    </div>

                </div>
            </div>

        </div>


        <AlertDialog v-model:open="showDeleteDialog">
            <AlertDialogContent>
                <AlertDialogHeader>
                    <AlertDialogTitle>Are you sure?</AlertDialogTitle>
                    <AlertDialogDescription>
                        This will permanently delete the selected account. This action cannot be undone.
                    </AlertDialogDescription>
                </AlertDialogHeader>
                <AlertDialogFooter>
                    <AlertDialogCancel @click="showDeleteDialog = false">Cancel</AlertDialogCancel>
                    <AlertDialogAction class="bg-red-600 hover:bg-red-700" @click="confirmDelete">
                        Delete
                    </AlertDialogAction>
                </AlertDialogFooter>
            </AlertDialogContent>
        </AlertDialog>

    </AuthenticatedLayout>
</template>

<script setup>
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/Components/ui/select'
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuSeparator,
    DropdownMenuShortcut,
    DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu'
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table'

import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/Components/ui/alert-dialog'
import { ref, onMounted, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import { Link, } from '@inertiajs/vue3';

import { Button } from '@/Components/ui/button'
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/Components/ui/dialog'
import {
    Drawer,
    DrawerClose,
    DrawerContent,
    DrawerDescription,
    DrawerFooter,
    DrawerHeader,
    DrawerTitle,
    DrawerTrigger,
} from '@/Components/ui/drawer'
import { createReusableTemplate, useMediaQuery } from '@vueuse/core'
// Reuse `form` section
const [UseTemplate, GridForm] = createReusableTemplate()
const isDesktop = useMediaQuery('(min-width: 768px)')

const isOpen = ref(false)

const props = defineProps({
    accounts: Array,
});

const isModalOpen = ref(false);
const showPassword = ref(false);

const form = useForm({
    id: null,
    name: '',
    email: '',
    password: '',
});

const openModal = (account) => {
    form.clearErrors(); // Clear errors when opening the modal

    if (account) {
        form.id = account.id;
        form.name = account.name;
        form.email = account.email;
        form.password = ''; // Reset password input
    } else {
        form.reset();
    }
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
};

const togglePassword = () => {
    showPassword.value = !showPassword.value;
};

const submitForm = () => {
    if (form.id) {
        form.put(route('accounts.update', form.id), {
            onSuccess: () => closeModal(),
        });
    } else {
        form.post(route('accounts.store'), {
            onSuccess: () => closeModal(),
        });
    }
};


const deleteForm = useForm({

})
const showDeleteDialog = ref(false);
const accountToDeleteId = ref(null);

const deleteAccount = (id) => {
    accountToDeleteId.value = id;
    showDeleteDialog.value = true;
};

const confirmDelete = () => {
    if (!accountToDeleteId.value) return;
    deleteForm.delete(route('accounts.delete', accountToDeleteId.value), {
        onSuccess: () => {
            showDeleteDialog.value = false;
            accountToDeleteId.value = null;
        }
    });
};

</script>
