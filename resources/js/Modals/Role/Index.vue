<template>
    <head-title title="Улоги | Земјоделски институт" />
    <table-view
        title="Улоги"
        button-text="Додади улога"
        :table-headers="tableHeaders"
        :can-see-create-button="true"
        :store-modal-pop-up="false"
        :links="roles.links"
        search-bar-placeholder="Пребарајте улога..."
        route-name="roles.index"
        create-route-name="roles.create"
        :date-filters="false"
    >
        <tr v-for="(role, i) in roles.data" :key="role.id">
            <td>
                {{ i + 1 }}
            </td>
            <td>
                {{ role.name }}
            </td>
            <td>
                <div class="d-flex flex-nowrap">
                    <Link
                        v-if="can.roles.update"
                        :href="route('roles.edit', role.id)"
                        class="btn btn-sm btn-success me-1 text-nowrap"
                    >
                        <i class="fa fa-pencil"></i> Измени
                    </Link>
                    <button
                        v-if="can.roles.delete"
                        class="btn btn-sm btn-primary ms-1 text-nowrap"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal"
                        data-bs-title="Избришете улога"
                        :data-bs-route="route('roles.destroy', role.id)"
                    >
                        <i class="fa fa-trash"></i> Избриши
                    </button>
                </div>
            </td>
        </tr>
    </table-view>
</template>

<script>
import AdminDefaultLayout from "../../Layouts/AdminDefaultLayout.vue";

export default {
    name: "Index",
    layout: AdminDefaultLayout,
};
</script>
<script setup>
import { inject } from "vue";
import { useBase } from "../../Mixins/useBase";
import HeadTitle from "../../Components/HeadTitle.vue";
import TableView from "../../Components/BaseComponents/BaseCrudTableView.vue";

defineProps({
    roles: {
        type: Object,
        default: null,
    },
    permissions: {
        type: Array,
        default: null,
    },
    error: {
        type: String,
        default: null,
    },
});

const route = inject("route");

const { can } = useBase();

const tableHeaders = ["#", "Име"];
</script>

<style scoped></style>
