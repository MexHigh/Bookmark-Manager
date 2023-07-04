import express from "express"
import { dirname, resolve } from 'path';
import { fileURLToPath } from 'url';

const __dirname = dirname(fileURLToPath(import.meta.url));

const app = express()

app.use(express.static("../frontend/build"))

app.get('*', (req, res) => {
  res.sendFile(resolve(__dirname, "../frontend/build/index.html"))
})

let port = 5000
console.log(`Server running on :${port}`)
app.listen(port)
