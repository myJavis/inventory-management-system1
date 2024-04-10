<script setup>
import { useRoute } from "vue-router";

import SidenavItem from "./SidenavItem.vue";


const getRoute = () => {
  const route = useRoute();
  const routeArr = route.path.split("/");
  return routeArr[1];
};
</script>
<template>
  <div
    class="collapse navbar-collapse w-auto h-auto h-100"
    id="sidenav-collapse-main"
  >
    <ul class="navbar-nav">
      <li class="nav-item">
        <sidenav-item
          to="/crud"
          :class="getRoute() === 'dashboard' ? 'active' : ''"
          :navText="'Product'"
        >
          <template v-slot:icon>
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
          </template>
        </sidenav-item>
      </li>

    </ul>
  </div>


</template>
