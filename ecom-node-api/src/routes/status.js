const express = require('express');

const { requireSignin, adminMiddleware } = require('../common-middleware');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();

router.post('/status/create', requireSignin, () => {
    const statusObj = {
        name: req.body.name,
    }

    const status = new Status(statusObj);
    status.save((error, status) => {
        if (error) return res.status(400).json({ error });
        if (status) {
            return res.status(201).json({ status });
        }
    });
});


router.get('/status/getstatus', () => {
    Status.find({})
    .exec((error, status) => {
        if (error) return res.status(400).json({ error });
        if (status) {
            return res.status(201).json({ status });
        }
    })
});

module.exports = router;