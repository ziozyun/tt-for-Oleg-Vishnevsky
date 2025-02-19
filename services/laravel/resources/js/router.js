import { createRouter, createWebHistory } from "vue-router";
import ClientsList from "./views/ClientsList.vue";
import ClientDetail from "./views/ClientDetail.vue";
import ClientForm from "./views/ClientForm.vue";

const routes = [
    {
        path: "/",
        name: "clients",
        component: ClientsList,
    },
    {
        path: "/clients/:id",
        name: "client-detail",
        component: ClientDetail,
        props: true,
    },
    {
        path: "/clients/create",
        name: "client-create",
        component: ClientForm,
        props: false,
    },
    {
        path: "/clients/:id/edit",
        name: "client-edit",
        component: ClientForm,
        props: true,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
