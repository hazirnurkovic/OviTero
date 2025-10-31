<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';
import { Form, Head } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();

function loginWithGoogle() {
    window.location.href = '/auth/redirect';
}
</script>

<template>
    <AuthBase
        title="Log in to your account"
        description="Enter your email and password below to log in"
    >
        <Head title="Log in" />

        <div
            v-if="status"
            class="mb-4 text-center text-sm font-medium text-green-600"
        >
            {{ status }}
        </div>

        <Form
            v-bind="store.form()"
            :reset-on-success="['password']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-6"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email">Email address</Label>
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        placeholder="email@example.com"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label for="password">Password</Label>
                        <TextLink
                            v-if="canResetPassword"
                            :href="request()"
                            class="text-sm"
                            :tabindex="5"
                        >
                            Forgot password?
                        </TextLink>
                    </div>
                    <Input
                        id="password"
                        type="password"
                        name="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        placeholder="Password"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="flex items-center justify-between">
                    <Label for="remember" class="flex items-center space-x-3">
                        <Checkbox id="remember" name="remember" :tabindex="3" />
                        <span>Remember me</span>
                    </Label>
                </div>

                <Button
                    type="submit"
                    class="mt-4 w-full"
                    :tabindex="4"
                    :disabled="processing"
                    data-test="login-button"
                >
                    <LoaderCircle
                        v-if="processing"
                        class="h-4 w-4 animate-spin"
                    />
                    Log in
                </Button>
            </div>
            <div class="flex flex-col items-center gap-2">
                Or login with
                <Button
                    type="button"
                    class="w-full flex items-center justify-center gap-2"
                    @click="loginWithGoogle"
                    :tabindex="6"
                    variant="outline"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 48 48">
                        <g>
                            <path fill="#4285F4" d="M24 9.5c3.54 0 6.7 1.23 9.19 3.25l6.85-6.85C36.18 2.69 30.45 0 24 0 14.64 0 6.4 5.84 2.44 14.36l7.98 6.21C12.17 14.13 17.61 9.5 24 9.5z"/>
                            <path fill="#34A853" d="M46.1 24.5c0-1.6-.14-3.13-.39-4.61H24v9.01h12.44c-.54 2.91-2.17 5.38-4.62 7.04l7.19 5.59C43.96 37.36 46.1 31.44 46.1 24.5z"/>
                            <path fill="#FBBC05" d="M10.42 28.57c-1.04-3.09-1.04-6.41 0-9.5l-7.98-6.21C.64 16.56 0 20.18 0 24c0 3.82.64 7.44 2.44 10.14l7.98-6.21z"/>
                            <path fill="#EA4335" d="M24 48c6.45 0 11.88-2.13 15.84-5.81l-7.19-5.59c-2.01 1.35-4.59 2.15-8.65 2.15-6.39 0-11.83-4.63-13.58-10.86l-7.98 6.21C6.4 42.16 14.64 48 24 48z"/>
                            <path fill="none" d="M0 0h48v48H0z"/>
                        </g>
                    </svg>
                    Google
                </Button>
            </div>
            <div
                class="text-center text-sm text-muted-foreground"
                v-if="canRegister"
            >
                Don't have an account?
                <TextLink :href="register()" :tabindex="5">Sign up</TextLink>
            </div>
        </Form>
    </AuthBase>
</template>
