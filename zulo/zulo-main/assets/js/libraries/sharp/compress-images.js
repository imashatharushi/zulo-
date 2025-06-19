const sharp = require('sharp');
const fs = require('fs');
const path = require('path');

const inputDir = '../../../img/categories'; // Folder with your images
const outputDir = '../../../img/low-quality'; // Folder to save compressed images

// Create output directory if it doesn't exist
if (!fs.existsSync(outputDir)) {
  fs.mkdirSync(outputDir);
}

// Function to compress images
function compressImage(inputPath, outputPath) {
  sharp(inputPath)
    .resize({ width: 800 }) // Adjust the width as needed
    .jpeg({ quality: 10 }) // Set the quality (for JPEG)
    .toFile(outputPath)
    .then(() => {
      console.log(`Compressed: ${inputPath} -> ${outputPath}`);
    })
    .catch((err) => {
      console.error(`Error compressing ${inputPath}:`, err);
    });
}

// Read all files in the input directory
fs.readdir(inputDir, (err, files) => {
  if (err) {
    console.error('Error reading directory:', err);
    return;
  }

  files.forEach((file) => {
    const inputPath = path.join(inputDir, file);
    const outputPath = path.join(outputDir, file);

    // Compress each image file
    if (/\.(jpg|jpeg|png|webp)$/i.test(file)) {
      compressImage(inputPath, outputPath);
    }
  });
});
