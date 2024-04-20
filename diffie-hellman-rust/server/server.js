const express = require('express');
const app = express();
const port = 3000;

let modulus = '';
let base = '';

let temp_key = '';

app.use(express.json());

app.post('/negotiate', (req, res) => {
    console.log('request recieved !');

    if (!base && !modulus) {
        modulus = req.body.modulus;
        base = req.body.base;

        res.status(200);
        res.send();
    } else {
        res.status(409);
        res.json({ modulus: modulus, base: base });
    }
});

app.post('/key', (req, res) => {
    if (!temp_key || req.body.key == temp_key) {
        console.log('exchange attempted');
        temp_key = req.body.key;
        res.status(202);
        res.send();
    } else {
        res.status(200);
        res.json({ key: temp_key });
        temp_key = req.body.key;
    }
});

app.get('/reset', (req, res) => {
    temp_key = '';
    modulus = '';
    base = '';
    res.status(200);
    res.send();
});

app.listen(port, () => {
    console.log(`listening on port ${port}`);
});
