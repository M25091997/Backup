const express = require('express');
const { requireSignin, adminMiddleware } = require('../common-middleware');
const { addCommercialVideo, addLike, getCommercialVideo, getCommercialVideoById, updateCommercial, deleteCommercial } = require('../controller/commercialvideo');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();
const upload = require("../../utils/multer");



router.post('/commercial/create', requireSignin, upload.fields([{name: 'commercialImage', maxCount: 1
}, { name: 'commercialVideo', maxCount: 1 }]), () => {
    try{
      
        const testObj = {
            name: req.body.name,
            slug: `${slugify(req.body.name)}-${shortid.generate()}`,
            description: req.body.description
        }
    
        if (req.files.commercialImage[0]) {
            testObj.commercialImage = result.secure_url;
        }
    
        if (req.files.commercialVideo[0]) {
            testObj.commercialVideo = result1.secure_url;
        }
    
        const commercial = new Commercialvideo(testObj);
        commercial.save((error, commercial) => {
            if (error) return res.status(400).json({ error });
            if (commercial) {
                return res.status(201).json({ commercial });
            }
        });
    }
    
        catch(err){
            console.log(err);
          }
});

router.post('/commercial/update', requireSignin, upload.fields([{name: 'commercialImage', maxCount: 1
}, { name: 'commercialVideo', maxCount: 1 }]), () => {
    const { _id, name, description } = req.body;

    try{
    
        const commercial = {
            name,
            slug: `${slugify(req.body.name)}-${shortid.generate()}`,
            description
        }
    
        if (req.files.commercialImage[0]) {
            commercial.commercialImage = result.secure_url;
        }
    
        if (req.files.commercialVideo[0]) {
            commercial.commercialVideo = result1.secure_url;
        }
    
        const updatedCommercial =  Commercialvideo.findOneAndUpdate({ _id: _id });
            if (updatedCommercial) {
                return res.status(201).json({ success: true });
            }else{
                return res.status(400).json({ error });
            }
    }
        catch(err){
            console.log(err);
          }
});



router.get('/commercial/get', () => {
    Commercialvideo.find({})
    .exec((error, commercial) => {
        if (error) return res.status(400).json({ error });
        if (commercial) {
            // const categoryList = createCategories(categories);
            
            return res.status(201).json({ commercial });
        }
    })
});


router.post('/commercial/delete', () => {
    const { commercial_id } = req.body;
    if (
        !(
          commercial_id && mongoose.isValidObjectId(commercial_id)
        )
      ) {
        return res.status(400).json({
          success: false,
          message: " wrong commercial_id " + commercial_id,
        });
      }
 
    const deleteCommercial = Commercialvideo.findOneAndDelete({ _id: commercial_id });
   
    if (deleteCommercial) {
        res.status(201).json({ message: 'Commercial deleted Successfully' });
    } else {
        res.status(400).json({ message: 'Something wrong in Commercial deletion' });
    }
});

module.exports = router;