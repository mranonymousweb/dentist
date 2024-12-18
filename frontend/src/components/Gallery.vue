<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

// متغیر برای ذخیره تصاویر
const images = ref([])

// فانکشن برای دریافت تصاویر از API
const fetchImages = async () => {
  try {
    const response = await axios.get('http://localhost:8000/gallery-home')
    images.value = response.data.images || [] // ذخیره داده‌ها در آرایه
  } catch (error) {
    console.error('Error fetching gallery images:', error)
  }
}

// دریافت داده‌ها هنگام mount شدن کامپوننت
onMounted(() => {
  fetchImages()
})
</script>

<template>
  <div class="section-title">
    <h2>نمونه کار ها</h2>
    <p>انواع مختلفی از خدمات دندانپزشکی برای حفظ سلامت دهان و دندان ها</p>
  </div>

  <!-- گالری تصاویر -->
  <div class="container-gallery">
    <div id="carousel">
      <!-- حلقه برای نمایش تصاویر -->
      <img v-for="(image, index) in images" :key="index" :src="image.image_url" :alt="'Image ' + index" />
    </div>
  </div>
</template>

<!-- <style scoped>
/* استایل برای گالری */
.container-gallery {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  justify-content: center;
}

#carousel img {
  width: 200px;
  height: 200px;
  object-fit: cover;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
}

#carousel img:hover {
  transform: scale(1.1);
}
</style> -->
