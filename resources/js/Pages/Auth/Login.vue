<template>
    <div
        class="container py-4 min-vh-100 d-flex align-items-center justify-content-center"
    >
        <div class="col col-12 col-md-6 col-lg-5">
            <div class="card shadow-lg bg-dark">
                <div class="card-body p-md-5 text-white text-center">
                    <h2 class="display-6 fw-bold mb-4">Најави се</h2>
                    <form @submit.prevent="login">
                        <div class="mb-3">
                            <label for="username" class="form-label"
                                >Корисничко име</label
                            >
                            <input
                                id="username"
                                v-model="form.username"
                                :class="{ 'is-invalid': form.errors.username }"
                                type="text"
                                class="form-control"
                                aria-describedby="username"
                            />
                            <div
                                v-if="form.errors.username"
                                class="invalid-feedback"
                                v-text="form.errors.username"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label"
                                >Лозинка</label
                            >
                            <input
                                id="password"
                                v-model="form.password"
                                :class="{ 'is-invalid': form.errors.email }"
                                type="password"
                                class="form-control"
                                aria-describedby="password"
                            />
                            <div
                                v-if="form.errors.email"
                                class="invalid-feedback"
                                v-text="form.errors.email"
                            />
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Најави се
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
};
</script>
<script setup>
import { inject } from "vue";
import {useForm} from "@inertiajs/inertia-vue3";

const route = inject("route");

const form = useForm({
    username: "",
    password: "",
});

const login = () => {
    console.log(form)
    form.post(route("login"));
};
</script>

<style scoped></style>
