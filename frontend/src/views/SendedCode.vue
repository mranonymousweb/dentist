<template>
    <div class="container">
      <!-- نمایش پیام موفقیت یا خطا -->
      <div v-if="messageStore.message" :class="`alert alert-${messageStore.messageType} m-3`" role="alert">
        {{ messageStore.message }}
      </div>
  
      <form class="user" @submit.prevent="submitVerificationCode">
        <input v-model="activeCode" type="text" class="form-control form-control-user" placeholder="کد تایید" />
        <ValidationErrors field="active_code" :errors="messageStore.errors" />
        <button type="submit" class="btn btn-primary btn-user btn-block">تایید کد</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref, onBeforeMount, onMounted, onUnmounted } from 'vue';
  import { useRouter } from 'vue-router';
  import { useAuthStore, useMessageStore } from '../stores';
  import ValidationErrors from '../components/ValidationErrors.vue';
  
  const router = useRouter();
  const authStore = useAuthStore();
  const messageStore = useMessageStore();
  
  onBeforeMount(() => {
    if (authStore.isLoggedIn) {
      router.push({ path: '/', replace: true });
    }
  });
  
  onMounted(() => {
    document.body.classList.add('bg-gradient-primary');
  });
  
  onUnmounted(() => {
    messageStore.$reset();
    document.body.classList.remove('bg-gradient-primary');
  });
  
  const activeCode = ref('');
  
  const submitVerificationCode = async () => {
    try {
      await authStore.verifyCode(activeCode.value);
      router.push({ path: '/', replace: true });
    } catch (error) {
      messageStore.message = 'کد تأیید اشتباه است.';
      messageStore.messageType = 'danger';
    }
  };
  </script>
  

<style scoped>
@import '../assets/css/sb-admin-2.min.css';
</style>
