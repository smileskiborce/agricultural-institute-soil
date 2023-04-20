<template>
    <div class="col col-12 mb-3">
        <h5 class="mb-3 fw-bold text-center text-lg-start">
            {{ tableTitle }}
        </h5>
        <div class="table-responsive">
            <table class="table table-hover table-striped border border-1">
                <tbody>
                    <tr
                        v-for="(header, i) in tableHeaders"
                        :key="i"
                        class="text-nowrap"
                    >
                        <th class="col col-5 fw-bold">{{ header }}:</th>
                        <td
                            class="col col-7 border border-start border-1 text-area-render"
                        >
                            {{ dataFieldNames[i] }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "BaseVerticalTable",
};
</script>
<script setup>
defineProps({
    tableHeaders: {
        type: Array,
        required: true,
    },
    dataFieldNames: {
        type: Array,
        required: true,
    },
    tableTitle: {
        type: String,
        required: true,
    },
});
</script>

<style scoped></style>
