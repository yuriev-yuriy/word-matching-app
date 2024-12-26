<template>
  <div id="app" class="min-h-screen">
    <ThemeToggle />
    <FileUpload @fileProcessed="handleFileProcessed" />
    <WordMatching v-if="words.length" :words="words" :fileName="fileName" />
  </div>
</template>


<script>
import FileUpload from "./components/FileUpload.vue";
import WordMatching from "./components/WordMatching.vue";
import ThemeToggle from "./components/ThemeToggle.vue";

export default {
  name: "App",
  components: {
    FileUpload,
    WordMatching,
    ThemeToggle,
  },
  data() {
    return {
      words: [],
      fileName: "",
    };
  },
  methods: {
    handleFileProcessed({ words, fileName }) {
      console.log("Received words:", words);
      console.log("Received fileName:", fileName);

      if (Array.isArray(words) && words.length > 0) {
        this.words = words;
        this.fileName = fileName;
      } else {
        console.warn("No valid data received.");
        this.words = [];
        this.fileName = "";
      }
    },
  },
};
</script>
