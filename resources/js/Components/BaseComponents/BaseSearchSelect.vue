<template>
    <div class="mb-2" :class="propsClass">
        <label class="form-label">{{ label }}</label>
        <v-select
            v-model="_value"
            :onmouseenter="value ? getSearchedList : getLatestRows"
            :onmouseleave="value ? getSearchedList : getLatestRows"
            :label="labelText"
            :options="list"
            :filter-by="customFilter"
            :reduce="(listArr) => listArr.id"
            @search="findRows"
        />
        <span v-if="invalid" class="text-danger">{{ invalid }}</span>
    </div>
    <link
        rel="stylesheet"
        href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css"
    />
</template>

<script>
export default {
    name: "BaseSearchSelect",
};
</script>
<script setup>
import { computed } from "vue";
import vSelect from "vue-select";
import { getParam } from "@/helpers";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    value: {
        type: [String, Number],
        default: "",
    },
    label: {
        type: String,
        required: true,
    },
    labelText: {
        type: String,
        required: true,
    },
    list: {
        type: Array,
        required: true,
    },
    searchName: {
        type: String,
        required: true,
    },
    routeName: {
        type: String,
        required: true,
    },
    objectId: {
        type: [String, Number],
        default: "",
    },
    propsClass: {
        type: String,
        default: "",
    },
    invalid: {
        type: String,
        default: "",
    },
});

const form = useForm({
    [props.searchName]: getParam(props.searchName),
});

const findRows = (options) => {
    if (options) form[props.searchName] = options;
    if (window.location.search && options) {
        if (props.objectId) {
            form.get(
                route(props.routeName, [
                    props.objectId,
                    window.location.search.slice(
                        window.location.search.indexOf("?") + 1
                    ),
                ]),
                {
                    preserveState: true,
                    preserveScroll: true,
                }
            );
        } else {
            form.get(
                route(
                    props.routeName,
                    window.location.search.slice(
                        window.location.search.indexOf("?") + 1
                    )
                ),
                {
                    preserveState: true,
                    preserveScroll: true,
                }
            );
        }
    } else if (!window.location.search && options) {
        if (form[props.searchName].searchName)
            form.get(
                route(props.routeName, form[props.searchName].searchName),
                {
                    preserveState: true,
                    preserveScroll: true,
                }
            );
        else {
            if (props.objectId) {
                form.get(
                    route(props.routeName, [
                        props.objectId,
                        window.location.search.slice(
                            window.location.search.indexOf("?") + 1
                        ),
                    ]),
                    {
                        preserveState: true,
                        preserveScroll: true,
                    }
                );
            } else {
                form.get(
                    route(
                        props.routeName,
                        window.location.search.slice(
                            window.location.search.indexOf("?") + 1
                        )
                    ),
                    {
                        preserveState: true,
                        preserveScroll: true,
                    }
                );
            }
        }
    }
};

const getLatestRows = () => {
    form[props.searchName] = "";
    if (props.value !== "")
        if (props.objectId) {
            form.get(
                route(props.routeName, [
                    props.objectId,
                    window.location.search.slice(
                        window.location.search.indexOf("?") + 1
                    ),
                ]),
                {
                    preserveState: true,
                    preserveScroll: true,
                }
            );
        } else {
            form.get(
                route(
                    props.routeName,
                    window.location.search.slice(
                        window.location.search.indexOf("?") + 1
                    )
                ),
                {
                    preserveState: true,
                    preserveScroll: true,
                }
            );
        }
};

const getSearchedList = () => {
    if (props.value !== "") {
        form[props.searchName] = props.value;
        findRows(props.value);
    }
};

const emit = defineEmits(["update:value"]);
const _value = computed({
    get() {
        return props.value;
    },
    set(val) {
        emit("update:value", val);
    },
});

const customFilter = (search) => {
    return search;
};
</script>

<style></style>
