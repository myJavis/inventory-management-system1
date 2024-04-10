

<template>
  <div class="container top-0 position-sticky z-index-sticky">
    <div class="row">
      <div class="col-12">
        <navbar isBlur="blur  border-radius-lg my-3 py-2 start-0 end-0 mx-4 shadow" v-bind:darkMode="true"
          isBtn="bg-gradient-success" />
      </div>
    </div>
  </div>
  <main class="mt-0 main-content">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="mx-auto col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0">
              <div class="card card-plain">
                <div class="pb-0 card-header text-start">
                  <h4 class="font-weight-bolder">Sign In</h4>
                  <p class="mb-0">Enter your username and password to sign in</p>
                </div>
                <div class="card-body">
                  <div v-if="loginError" class="alert alert-danger" role="alert">
    Login failed. Please check your credentials.
  </div>
                  <form role="form" @submit="handleSubmit">
                    <div class="mb-3">
                      <argon-input id="username" type="text" placeholder="Username" name="username" size="lg"
                        v-model="username" />
                    </div>
                    <div class="mb-3">
                      <argon-input id="password" type="password" placeholder="Password" name="password" size="lg"
                        v-model="password" />
                    </div>
                    <argon-switch id="rememberMe" name="remember-me">Remember me</argon-switch>

                    <div class="text-center">
                      <argon-button class="mt-4" variant="gradient" color="success" fullWidth size="lg"
                        @click="login">Sign in</argon-button>
                    </div>
                  </form>
                </div>
                <div class="px-1 pt-0 text-center card-footer px-lg-2">
                  <p class="mx-auto mb-4 text-sm">
                    Don't have an account?
                    <a href="javascript:;" class="text-success text-gradient font-weight-bold">Sign up</a>
                  </p>
                </div>
              </div>
            </div>
            <div
              class="top-0 my-auto text-center col-6 d-lg-flex d-none h-100 pe-0 position-absolute end-0 justify-content-center flex-column">
              <div
                class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                style="
                  background-image: url(&quot;https://usawire.com/wp-content/uploads/2024/02/depositphotos_506286024-stock-photo-smart-warehouse-management-system-with.webp&quot;);
                  background-size: cover;
                ">
                <span class="mask bg-gradient-success opacity-6"></span>
                <div class="container">
                  <div class="row">
                    <div class="col-md-8 offset-md-2 text-center">
                      <h2 class="mt-5 text-white font-weight-bold">
                        Welcome to Our Inventory Management System
                      </h2>
                      <p class="lead mt-4 text-white">
                        Managing your inventory has never been easier. Our system provides you with the tools and
                        insights you need to streamline your inventory operations.
                      </p>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>


<script setup>
import { onBeforeUnmount, onBeforeMount } from "vue";
import { useStore } from "vuex";
import ArgonInput from "@/components/ArgonInput.vue";
import ArgonSwitch from "@/components/ArgonSwitch.vue";
import ArgonButton from "@/components/ArgonButton.vue";

const body = document.getElementsByTagName("body")[0];

const store = useStore();
onBeforeMount(() => {
  store.state.hideConfigButton = true;
  store.state.showNavbar = false;
  store.state.showSidenav = false;
  store.state.showFooter = false;
  body.classList.remove("bg-gray-100");
});
onBeforeUnmount(() => {
  store.state.hideConfigButton = false;
  store.state.showNavbar = false;
  store.state.showSidenav = true;
  store.state.showFooter = true;
  body.classList.add("bg-gray-100");
});

import { ref } from "vue";
import axios from "axios"; // Import Axios for making HTTP requests
import { useRouter } from "vue-router"; // Import Vue Router

const router = useRouter(); // Initialize Vue Router

const username = ref(""); // Initialize reactive variables for username and password
const password = ref("");
const loginError = ref(false); // Reactive variable to track login errors

const login = async () => {
  loginError.value = false; // Reset login error before attempting login
  try {
    const response = await axios.post("http://localhost:8000/api/login", {
      username: username.value,
      password: password.value,
    });

    // Check if response contains a token
    if (response.data.token) {
      // Redirect to /dashboard using Vue Router
      router.push("/crud");
    } else {
      // Set loginError to true to display the error message
      loginError.value = true;
    }
  } catch (error) {
    // Set loginError to true to display the error message
    loginError.value = true;
    // Log the error if login fails
    console.error("Login failed:", error);
  }
};

const handleSubmit = (event) => {
  event.preventDefault(); // Prevent the default form submission behavior
  login(); // Call your login method when the form is submitted
};
</script>

<style scoped>
.alert {
  margin-top: 10px;
}
</style>