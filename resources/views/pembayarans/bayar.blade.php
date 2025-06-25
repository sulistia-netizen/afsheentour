<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap"
    rel="stylesheet"
  />
  <style>
    body {
      font-family: 'Indie Flower', cursive;
    }
  </style>
</head>
<body class="bg-[#f8fbff] min-h-screen flex items-center justify-center p-4">
  <form
    class="border-2 border-black rounded-md p-6 w-full max-w-xs"
    autocomplete="off"
  >
    <div class="flex items-center space-x-2 mb-6">
      <label
        for="rekening"
        class="border-2 border-black rounded px-1 text-black text-lg"
        >rekening tujuan:</label
      >
      <select
        id="rekening"
        class="outline-none text-black text-lg font-normal border-none bg-transparent"
      >
        <option value="0-213901238120" selected>0-213901238120</option>
        <option value="1-123456789012">1-123456789012</option>
        <option value="2-987654321098">2-987654321098</option>
      </select>
    </div>
    <input
      type="text"
      placeholder="keterangan"
      class="border-2 border-black rounded w-full mb-6 px-2 py-2 text-black text-lg font-normal placeholder:text-black placeholder:font-normal"
    />
    <label
      for="upload"
      class="border-2 border-black rounded w-full block mb-6 px-2 py-10 text-black text-lg font-normal text-center cursor-pointer"
      >upload bukti pembayaran</label
    >
    <input id="upload" type="file" class="hidden" />
    <input
      type="submit"
      value=""
      class="border-2 border-black rounded w-24 h-10 ml-auto block cursor-pointer"
    />
  </form>
</body>
</html>