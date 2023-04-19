import {usePage} from "@inertiajs/vue3";
import { computed } from "vue";

export function useBase() {

    const user = computed(() => usePage().props.user);

    const can = computed(() => usePage().props.can);

    const error = computed(() => usePage().props.error);

    const success = computed(() => usePage().props.success);

    return {
        can,
        user,
        error,
        success,
    };
}
