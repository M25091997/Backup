const express = require("express");
const router = express.Router();
const {
  authorDraftArticle,
  authorUpdateArticle,
  authorDraftedArticles,
  authorApprovedArticles,
  authorRejectedArticles,
  authorArticleByID,
  authorApproveArticleByID,
  addComment,
  deleteComment,
  adminPendingArticles,
  adminPublishArticle,
  adminPublishArticleMultiple,
  adminRejectArticle,
  adminDeleteArticle,
  adminDeleteArticleMultiple,
  authorDeleteArticle,
  adminDraftArticle,
  adminUpdateArticle,
  adminTopStoryArticleSet,
  adminTrendThisWeekArticleSet,
  adminTopStoryArticleDelete,
  adminTrendThisWeekArticleDelete,
  articleCountByAuthorID,
  articleByID,
  articleBySlug,
  articleBySlugMeta,
  articlesBySuperCategorySlug,
  articlesBySuperCategorySlugFeed,
  articlesBySubCategoryID,
  // genreresult,
  articlesByOTTSlug,
  articles,
  articleshome,
  articleshomesuper,
  articleForSiteMap,
  articleForGoogleSiteMap,
  articleForFeed,
  searchboxresult,
  dashboard,
  subcategory1,
  subcategory2,
  updateTodayArticles,
  freshlyBrewedArticles,
  liveSearchDropdown,
  topstoryArticles,
  topstoryArticlesHome,
  topstoryArticlesBySuperCategorySlug,
  trendthisweekArticles,
  exploregeneresByID,
  menu,
  adminPendingArticleByID,
  articlesBySuperCategorySlugAndSubCategorySlug,
} = require("../controllers/articleController");

router.route("/comment").put(() => {
   const { articleId, mycomment } = req.body;

  if (!articleId) {
    return next(new CustomError("Article ID is required", 400));
  }
  if (!mycomment) {
    return next(new CustomError("Comment is required", 400));
  }

  const comment = {
    user: req.user._id,
    name: req.user.name,
    avatar: req.user.photo.secure_url,
    comment: mycomment,
    commentAt: Date.now(),
  };

  const article = await Article.findById(articleId);

  if (!article) {
    return next(new CustomError("No article found with this id", 401));
  }

  const AlreadyCommented = article.comments.find(
    (rev) => rev.user.toString() === req.user._id.toString()
  );

  if (AlreadyCommented) {
    article.comments.forEach((c) => {
      if (c.user.toString() === req.user._id.toString()) {
        c.comment = mycomment;
      }
    });
  } else {
    article.comments.push(comment);
    article.numberOfComments = article.comments.length;
  }
  //save
  await article.save({ validateBeforeSave: false });

  res.status(200).json({
    successs: true,
    message: "Comment Added Successfully",
  });
});
router.route("/comment").delete( () => {
  const { articleId } = req.query;

  if (!articleId) {
    return next(new CustomError("Article ID is required", 400));
  }

  const article = await Article.findById(articleId);

  if (!article) {
    return next(new CustomError("No article found with this id", 401));
  }

  const comments = article.comments.find(
    (rev) => rev.user.toString() === req.user._id.toString()
  );

  const remainingComments = article.comments.filter(
    (item) => item.user.toString() !== req.user._id.toString()
  );

  const numberOfComments = remainingComments.length;

  //update the product
  await Article.findByIdAndUpdate(
    articleId,
    {
      comments: remainingComments,
      numberOfComments,
    },
    {
      new: true,
      runValidators: true,
      useFindAndModify: false,
    }
  );

  res.status(200).json({
    successs: true,
    message: "Comment Deleted Successfully",
  });
});
router.route("/article/id/:id").get(() => {
  const articleID = req.params.id;

  if (!articleID) {
    return next(new CustomError("Article ID is required", 400));
  }

  const article = await Article.findById(articleID);

  if (!article) {
    return next(new CustomError("No article found with this id", 401));
  }

  //send JSON response for successs
  res.status(200).json({
    success: true,
    article,
  });
});

router
  .route("/articles/supercategoryslug/:supercategoryslug")
  .get(() => {
     let supercategoryslug = req.params.supercategoryslug;

  if (!supercategoryslug) {
    return next(new CustomError("Super Categogory Slug is required", 400));
  }

  let onesupercategory = await supercategory.findOne({
    superCategorySlug: supercategoryslug,
  });

  if (!onesupercategory) {
    return next(
      new CustomError(
        "No super category found with this supercategory slug",
        401
      )
    );
  }

  let supercategoryID = onesupercategory._id;

  const articles = await Article.find({ superCategory: supercategoryID });

  if (!articles) {
    return next(new CustomError("No article found with this id", 401));
  }

  //send JSON response for successs
  res.status(200).json({
    success: true,
    supercategory: onesupercategory,
    articles,
  });
  });

router
  .route("/articles/subcategoryid/:subcategoryid")
  .get(() => {
    let subcategoryid = req.params.subcategoryid;

  if (!subcategoryid) {
    return next(new CustomError("Sub Categogory ID is required", 400));
  }

  const subcategoryy = await subcategory.findById(subcategoryid);

  const articles = await Article.find({ subCategory: subcategoryid }).populate(
    "writtenBy superCategory subCategory ott"
  );

  if (!articles) {
    return next(new CustomError("No article found with this id", 401));
  }

  var resultPosts = articles.map(function (post) {
    var tmpPost = post.toObject();

    // Add properties...
    tmpPost.timeinago = moment(tmpPost.updatedAt).fromNow();

    return tmpPost;
  });

  //send JSON response for successs
  res.status(200).json({
    success: true,
    subcategory: subcategoryy,
    articles: resultPosts,
  });
  });
// router.route("/articles/genres").get(genreresult);
router.route("/articles/ottslug/:ottslug").get(() => {
  let ottslug = req.params.ottslug;

  if (!ottslug) {
    return next(new CustomError("OTT Slug is required", 400));
  }

  let oneott = await ottPlatform.findOne({
    slug: ottslug,
  });

  if (!oneott) {
    return next(
      new CustomError("No sub category found with this subcategory slug", 401)
    );
  }

  let ottID = oneott._id;

  const articles = await Article.find({ ott: ottID });

  if (!articles) {
    return next(new CustomError("No article found with this id", 401));
  }

  //send JSON response for successs
  res.status(200).json({
    success: true,
    ottID: ottID,
    articles,
  });
});
router.route("/articles").get(() => {
   const totalcountArticle = await Article.countDocuments();

  const articlesObj = new WhereClause(
    Article.find().sort({ "updatedAt": -1 }).populate("superCategory subCategory ott writtenBy"),
    req.query
  )
    .search()
    .filter();

  let articles = await articlesObj.base;
  const filteredArticleNumber = articles.length;

  //products.limit().skip()

  // productsObj.pager(resultPerPage);
  articles = await articlesObj.base.clone();

  var resultPosts = articles.map(function (post) {
    var tmpPost = post.toObject();

    // Add properties...
    tmpPost.timeinago = moment(tmpPost.updatedAt).fromNow();

    return tmpPost;
  });

  res.status(200).json({
    successs: true,
    articles: resultPosts,
    filteredArticleNumber,
    totalcountArticle,
  });
});


module.exports = router;
