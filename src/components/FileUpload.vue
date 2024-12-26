<template>
  <div class="flex flex-col items-center space-y-6 mt-12">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Upload your Excel file</h2>
    <input
      type="file"
      accept=".xlsx, .xls"
      @change="handleFileUpload"
      class="border p-2 rounded dark:bg-gray-800 dark:text-white"
    />
  </div>
</template>

<script>
import * as XLSX from "xlsx";

export default {
  name: "FileUpload",
  methods: {
    handleFileUpload(event) {
      const file = event.target.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = (e) => {
        const data = new Uint8Array(e.target.result);
        const workbook = XLSX.read(data, { type: "array" });
        const firstSheetName = workbook.SheetNames[0];
        const worksheet = workbook.Sheets[firstSheetName];
        const jsonData = XLSX.utils.sheet_to_json(worksheet, { header: ["word", "match"], defval: "" });

        // Удаляем первую строку (заголовки)
        const filteredData = jsonData;

        console.log("Processed words:", filteredData);
        // Передаём данные в родительский компонент
        this.$emit("fileProcessed", { words: filteredData, fileName: file.name });
      };
      reader.readAsArrayBuffer(file);
    },
  },
};
</script>