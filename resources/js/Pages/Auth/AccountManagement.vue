<template>
    <AuthenticatedLayout>
        <div class="p-6 bg-white rounded-lg shadow-md">
            <div class="flex justify-between mb-4">
                <h2 class="text-xl font-semibold">Account Management</h2>
                <button @click="openModal(null)" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                    Add Account
                </button>
            </div>

            <!-- Accounts Table -->
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Name</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="account in accounts" :key="account.id">
                            <td class="px-4 py-2 border">{{ account.id }}</td>
                            <td class="px-4 py-2 border">{{ account.name }}</td>
                            <td class="px-4 py-2 border">{{ account.email }}</td>
                            <td class="px-4 py-2 border space-x-2">
                                <button @click="openModal(account)" class="px-3 py-1 text-white bg-yellow-500 rounded hover:bg-yellow-600">
                                    Edit
                                </button>
                                <button v-if="$page.props.auth.user.email === 'test@gmail.com'" @click="deleteAccount(account.id)" class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal for Adding & Editing Accounts -->
        <div v-if="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="w-96 p-6 bg-white rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4">{{ form.id ? 'Edit Account' : 'Add Account' }}</h3>

                <label class="block mb-2">Name</label>
                <input v-model="form.name" type="text" class="w-full px-3 py-2 border rounded" />
                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>

                <label class="block mt-4 mb-2">Email</label>
                <input v-model="form.email" type="email" class="w-full px-3 py-2 border rounded" />
                <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>

                <label class="block mt-4 mb-2">Password</label>
                <div class="relative">
                    <input 
                        :type="showPassword ? 'text' : 'password'" 
                        v-model="form.password" 
                        class="w-full px-3 py-2 border rounded pr-10"
                        :placeholder="form.id ? 'Leave blank to keep current password' : ''" 
                    />
                    <!-- Show/Hide Password Icon -->
                    <span @click="togglePassword" class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500 hover:text-gray-700">
                        <svg v-if="showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.5a9.457 9.457 0 0116.04 0M21 12s-3 5-9 5-9-5-9-5m9 5c4.418 0 8-2.686 8-6s-3.582-6-8-6-8 2.686-8 6 3.582 6 8 6z" />
                        </svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18m-1.5-1.5A9.457 9.457 0 0112 19.5c-4.418 0-8-2.686-8-6s3.582-6 8-6c1.444 0 2.8.342 4 .948M15.5 10c.758 0 1.493.177 2.166.496M9 15l6-6m-3 6V9" />
                        </svg>
                    </span>
                </div>
                <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</div>

                <div class="mt-4 flex justify-end space-x-2">
                    <button @click="closeModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Cancel
                    </button>
                    <button @click="submitForm" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { route } from '../../../../vendor/tightenco/ziggy/src/js';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

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
const deleteAccount = (id) => {
    if(confirm('Are you sure you want to delete this account?')){
        deleteForm.delete(route('accounts.delete', id))
    }
}
</script>
