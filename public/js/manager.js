









const target = document.getElementById("menu");
target.addEventListener('click', () => {
  target.classList.toggle('open');
  const nav = document.getElementById("nav");
  nav.classList.toggle('in');
});

//---------------------------------------------------------

const startCameraButton = document.getElementById('startCamera');
const cameraFeed = document.getElementById('cameraFeed');
const qrCanvas = document.getElementById('qrCanvas');
const qrScanner = new QrScanner(cameraFeed, result => handleQRScan(result));

async function handleQRScan(result) {
    console.log('QR code scanned:', result);
    // ここでQRコードの内容を処理するためのロジックを追加します
}

startCameraButton.addEventListener('click', async () => {
    try {
        await qrScanner.start();
    } catch (error) {
        console.error('Error starting camera:', error);
    }
});