<script setup lang="ts">
import { Button } from '@/components/ui/button'
import { Card, CardContent } from '@/Components/ui/card'
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>
<template>
    <div class="flex flex-col gap-6">
        <Card class="overflow-hidden">
            <CardContent class="grid p-0 md:grid-cols-2">
                <form @submit.prevent="submit" class="p-6 md:p-8">
                    <div class="flex flex-col gap-6">
                        <div class="flex flex-col items-center text-center">
                            <h1 class="text-2xl font-bold">
                                Welcome back
                            </h1>
                            <p class="text-balance text-muted-foreground">
                                Login to your EHR account
                            </p>
                        </div>
                        <div class="grid gap-2">
                            <Label for="email">Email</Label>
                            <Input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                                autofocus autocomplete="username" />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="grid gap-2">
                            <div class="flex items-center">
                                <Label for="password">Password</Label>
                           
                            </div>
                            <Input id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                                required autocomplete="current-password" />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>
                        <Button type="submit" class="w-full">
                            Login
                        </Button>
                        
                      
                    </div>
                </form>
                <div class="relative hidden bg-gray-50 md:block">
                    <img src="../../Images/LOGO.png" alt="Image"
                        class="absolute inset-0 h-full w-full object-cover dark:brightness-[0.2] dark:grayscale">
                </div>
            </CardContent>
        </Card>
        <div
            class="text-balance text-center text-xs text-muted-foreground [&_a]:underline [&_a]:underline-offset-4 hover:[&_a]:text-primary">
            By clicking continue, you agree to our <a href="#">Terms of Service</a>
            and <a href="#">Privacy Policy</a>.
        </div>
    </div>
</template>
