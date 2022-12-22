const toSlug = (str) => {
  str = str.toLowerCase();

  str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/gi, "a");
  str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/gi, "e");
  str = str.replace(/ì|í|ị|ỉ|ĩ/gi, "i");
  str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/gi, "o");
  str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/gi, "u");
  str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/gi, "y");
  str = str.replace(/đ/gi, "d");
  // Some system encode vietnamese combining accent as individual utf-8 characters
  // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
  str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/gi, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
  str = str.replace(/\u02C6|\u0306|\u031B/gi, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
  // Remove extra spaces
  // Bỏ các khoảng trắng liền nhau
  str = str.replace(/ + /gi, " ");
  str = str.trim();
  // Remove punctuations
  // Bỏ dấu câu, kí tự đặc biệt
  str = str.replace(
    /!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/gi,
    ""
  );
  str = str.trim();
  str = str.replace(/ /gi, "-");
  str = str.replace(/-+-/gi, "-");
  return str;
};

let nameService = document.querySelector(".name-service");
let slug = document.querySelector(".slug");
if (nameService && slug) {
  nameService.onkeyup = (e) => {
    slug.value = toSlug(e.target.value);
  };
}

let renderLink = document.querySelector(".render-link");
if (renderLink) {
  renderLink.querySelector(
    "span"
  ).innerHTML = `<a href="${urlRoot}" target="_blank">${urlRoot}</a>`;
}

// CKEDITOR.replace('editor');

let editors = document.querySelectorAll(".editor");
if (editors) {
  editors.forEach((item, index) => {
    item.id = `editor_${index + 1}`;
    let editor = CKEDITOR.replace(item.id);
    CKFinder.setupCKEditor(editor);
  });
}

const openPopup = (item) => {
  let parent = item.parentElement;
  while (!parent.classList.contains("ckfinder-group") && parent) {
    parent = parent.parentElement;
  }
  let imageRender = parent.querySelector(".image-render");
  CKFinder.popup({
    chooseFiles: true,
    width: 800,
    height: 600,
    onInit: function (finder) {
      finder.on("files:choose", function (evt) {
        let fileUrl = evt.data.files.first().getUrl();
        imageRender.value = fileUrl;
        //Xử lý chèn link ảnh vào input
      });
      finder.on("file:choose:resizedImage", function (evt) {
        let fileUrl = evt.data.resizedUrl;
        //Xử lý chèn link ảnh vào input
      });
    },
  });
};

let chooseImages = document.querySelectorAll(".choose-image");
if (chooseImages) {
  chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
}

let galleryItem = `<div class="gallery-item mb-2">
<div class="row ckfinder-group">
    <div class="col-9">
        <input type="text" name="gallery[]" placeholder="Hình ảnh..." class="form-control image-render" > 
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
    </div>
    <div class="col-1">
        <button onclick="return confirm('Bạn có thực sự muốn xóa?')" type="button" class="btn btn-danger btn-block delete-image"><i class="fa fa-trash"></i></button>
    </div>
</div>
</div>`;

const handleBtnDelete = (galleryGroup, classBtnDelete, itemDelete) => {
  let btnDelete = galleryGroup.querySelectorAll(`.${classBtnDelete}`);
  if (btnDelete) {
    btnDelete.forEach(
      (item) =>
        (item.onclick = () => {
          if (confirm("Bạn có thực sự muốn xóa?")) {
            let parent = item.parentElement;
            while (!parent.classList.contains(itemDelete)) {
              parent = parent.parentElement;
            }
            parent.remove();
          }
        })
    );
  }
};

let galleryGroup = document.querySelector(".gallery-group");
if (galleryGroup) {
  let btnAddImage = document.querySelector(".gallery-add-img");
  if (btnAddImage) {
    btnAddImage.onclick = () => {
      let galleryItemNode = new DOMParser()
        .parseFromString(galleryItem, "text/html")
        .querySelector(".gallery-item");
      galleryGroup.appendChild(galleryItemNode);
      let chooseImages = document.querySelectorAll(".choose-image");
      if (chooseImages) {
        chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
      }
      handleBtnDelete(galleryGroup, "delete-image", "gallery-item");
    };
  }
  handleBtnDelete(galleryGroup, "delete-image", "gallery-item");
}

let slideItem = `<div class="slide">
<div class="form-group">
    <label for="">Tên slide</label>
    <input type="text" name="name[]" placeholder="Tên slide..." class="form-control" >
</div>
<div class="form-group">
    <label for="">Nội dung</label>
    <textarea class="editor" class="form-control" placeholder="Nội dung..." name="content[]" ></textarea>
</div>
<div class="row">
    <div class="col-6">
    <div class="form-group">
    <label for="">Tên nút nhấn</label>
    <input type="text" name="btn_name[]" placeholder="Tên nút nhấn..." class="form-control">
     </div>
    </div>
    <div class="col-6">
    <div class="form-group">
    <label for="">Link video</label>
    <input type="text" name="link_video[]" placeholder="Link video..." class="form-control">
</div>
    </div>
</div>
<div class="row">
    <div class="col-6">
    <div class="form-group">
    <label for="">Hình ảnh 1</label>
    <div class="row ckfinder-group">
        <div class="col-10">
            <input type="text" name="image_1[]" placeholder="Hình ảnh 1..." class="form-control image-render" >
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-upload"></i></button>
        </div>
    </div>
    </div>
    </div>
    <div class="col-6">
    <div class="form-group">
    <label for="">Hình ảnh 2</label>
    <div class="row ckfinder-group">
        <div class="col-10">
            <input type="text" name="image_2[]" placeholder="Hình ảnh 2..." class="form-control image-render" >
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-upload"></i></button>
        </div>
    </div>
    </div>
    </div>
</div>
<div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Hình nền</label>
                            <div class="row ckfinder-group">
                                <div class="col-10">
                                    <input type="text" name="backgroud_image[]" placeholder="Hình nền..."
                                        class="form-control image-render" >
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-success btn-block choose-image"><i
                                            class="fas fa-upload"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Vị trí hình ảnh</label>
                            <select class="form-control" name="positon_image[]" id="">
                                <option value="left">Bên trái</option>
                                <option value="right">Bên phải</option>
                                <option value="center">Ở giữa</option>
                            </select>
                        </div>
                    </div>
                </div>
<button type="submit" class="btn btn-danger delete-slide">Hủy</button>
<hr>
</div>
</div>`;

let slideGroup = document.querySelector(".group-slide");
if (slideGroup) {
  let btnAddSlide = document.querySelector(".btn-add-slide");
  if (btnAddSlide) {
    btnAddSlide.onclick = () => {
      let slideItemNode = new DOMParser()
        .parseFromString(slideItem, "text/html")
        .querySelector(".slide");
      slideGroup.appendChild(slideItemNode);
      let chooseImages = document.querySelectorAll(".choose-image");
      if (chooseImages) {
        chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
      }
      handleBtnDelete(slideGroup, "delete-slide", "slide");
    };
  }
  handleBtnDelete(slideGroup, "delete-slide", "slide");
}

let contactItem = `<div class="evaluate">
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <input name="range_name[]" type="text" class="form-control" placeholder="Tên đánh giá...">
        </div>
    </div>
    <div class="col-5">
        <div class="form-group">
            <input class="form-control range" id="range" type="text" name="range[]" value="">
        </div>
    </div>
    <div class="col-1">
        <button class="btn btn-danger delete-evaluate"><i class="fas fa-trash"></i></button>
    </div>
</div>
</div>`;

let evaluateGroup = document.querySelector(".group-evaluate");
if (evaluateGroup) {
  let btnAddEvaluate = document.querySelector(".btn-add-evaluate");
  if (btnAddEvaluate) {
    btnAddEvaluate.onclick = (e) => {
      e.preventDefault();
      let evaluatetItemNode = new DOMParser()
        .parseFromString(contactItem, "text/html")
        .querySelector(".evaluate");
      evaluateGroup.appendChild(evaluatetItemNode);
      let chooseImages = document.querySelectorAll(".choose-image");
      if (chooseImages) {
        chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
      }
      handleBtnDelete(evaluateGroup, "delete-evaluate", "evaluate");
      $(".range").ionRangeSlider({
        min: 0,
        max: 100,
        type: "single",
        step: 1,
        postfix: "%",
        prettify: false,
        hasGrid: true,
      });
    };
  }
  handleBtnDelete(evaluateGroup, "delete-evaluate", "evaluate");
}

$(".range").ionRangeSlider({
  min: 0,
  max: 100,
  type: "single",
  step: 1,
  postfix: "%",
  prettify: false,
  hasGrid: true,
});

let partnerItem = `<div class="row partner">

<div class="col-6">
    <div class="form-group">
        <div class="row ckfinder-group">
            <div class="col-10">
                <input type="text" name="image[]" placeholder="Logo..." class="form-control image-render"
                    >
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-success btn-block choose-image"><i
                        class="fas fa-upload"></i></button>
            </div>
        </div>
    </div>
</div>
<div class="col-5">
    <div class="form-group">
        <input type="text" name="link[]" placeholder="Link ..." class="form-control" />
    </div>
</div>
<div class="col-1">
    <button class="btn btn-danger delete-partner"><i class="fas fa-trash"></i></button>
</div>
</div>`;

let partnerGroup = document.querySelector(".group-partner");
if (partnerGroup) {
  let btnAddPartner = document.querySelector(".btn-add-partner");
  if (btnAddPartner) {
    btnAddPartner.onclick = (e) => {
      e.preventDefault();
      let partnerItemNode = new DOMParser()
        .parseFromString(partnerItem, "text/html")
        .querySelector(".partner");
      partnerGroup.appendChild(partnerItemNode);
      let chooseImages = document.querySelectorAll(".choose-image");
      if (chooseImages) {
        chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
      }
      handleBtnDelete(partnerGroup, "delete-partner", "partner");
    };
  }
  handleBtnDelete(partnerGroup, "delete-partner", "partner");
}

let quicklinkItem = `<div class="row quicklink">

<div class="col-6">
    <div class="form-group">
        <input type="text" name="name_quicklink[]" placeholder="Tên đường dẫn ..." class="form-control"
            >
    </div>
</div>
<div class="col-5">
    <div class="form-group">
        <input type="text" name="link_quicklink[]" placeholder="Đường dẫn ..." class="form-control" >
    </div>
</div>
<div class="col-1">
    <button class="btn btn-danger delete-quicklink"><i class="fas fa-trash"></i></button>
</div>
</div>`;

let quicklinkGroup = document.querySelector(".group-quicklink");
if (quicklinkGroup) {
  let btnAddquicklink = document.querySelector(".btn-add-quicklink");
  if (btnAddquicklink) {
    btnAddquicklink.onclick = (e) => {
      e.preventDefault();
      let quicklinkItemNode = new DOMParser()
        .parseFromString(quicklinkItem, "text/html")
        .querySelector(".quicklink");
      quicklinkGroup.appendChild(quicklinkItemNode);
      let chooseImages = document.querySelectorAll(".choose-image");
      if (chooseImages) {
        chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
      }
      handleBtnDelete(quicklinkGroup, "delete-quicklink", "quicklink");
    };
  }
  handleBtnDelete(quicklinkGroup, "delete-quicklink", "quicklink");
}

let account_twitterItem = `
<div class="account_twitter">
<br />
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="">Tên tài khoản</label>
            <input type="text" name="name_account_twitter[]" placeholder="Tên tài khoản ..."
                class="form-control" >
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="">Đường dẫn</label>
            <input type="text" name="link_account_twitter[]" placeholder="Đường dẫn ..."
                class="form-control" >
        </div>
    </div>
</div>
<div class="form-group">
    <label for="">Mô tả tài khoản</label>
    <input type="text" name="des_account_twitter[]" placeholder="Mô tả tài khoản..."
        class="form-control" >
</div>

<button class="btn btn-danger delete-account_twitter"><i class="fas fa-trash"></i></button>
</div>
`;

let account_twitterGroup = document.querySelector(".group-account_twitter");
if (account_twitterGroup) {
  let btnAddaccount_twitter = document.querySelector(
    ".btn-add-account_twitter"
  );
  if (btnAddaccount_twitter) {
    btnAddaccount_twitter.onclick = (e) => {
      e.preventDefault();
      let account_twitterItemNode = new DOMParser()
        .parseFromString(account_twitterItem, "text/html")
        .querySelector(".account_twitter");
      account_twitterGroup.appendChild(account_twitterItemNode);
      let chooseImages = document.querySelectorAll(".choose-image");
      if (chooseImages) {
        chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
      }
      handleBtnDelete(
        account_twitterGroup,
        "delete-account_twitter",
        "account_twitter"
      );
    };
  }
  handleBtnDelete(
    account_twitterGroup,
    "delete-account_twitter",
    "account_twitter"
  );
}

let ourteamItem = `
<div class="ourteam">
                <br>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Tên thành viên</label>
                            <input type="text" name="name[]" placeholder="Tên thành viên ..." class="form-control"
                                value="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Chức vụ</label>
                            <input type="text" name="position[]" placeholder="Chức vụ ..." class="form-control"
                                value="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Hình ảnh</label>
                            <div class="row ckfinder-group">
                                <div class="col-10">
                                    <input type="text" name="image[]" placeholder="Hỉnh ảnh..."
                                        class="form-control image-render" value="">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-success btn-block choose-image"><i
                                            class="fas fa-upload"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Đường dẫn</label>
                            <input type="text" name="link[]" placeholder="Đường dẫn ..." class="form-control" value="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Facebook</label>
                            <input type="text" name="facebook[]" placeholder="Facebook..." class="form-control"
                                value="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Twitter</label>
                            <input type="text" name="twitter[]" placeholder="Twitter ..." class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Youtube</label>
                            <input type="text" name="youtube[]" placeholder="Youtube ..." class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Github</label>
                            <input type="text" name="github[]" placeholder="Github ..." class="form-control" value="">
                        </div>
                    </div>
                </div>
                <hr />
            </div>
            `;

let ourteamGroup = document.querySelector(".group-ourteam");
if (ourteamGroup) {
  let btnAddourteam = document.querySelector(".btn-add-ourteam");
  if (btnAddourteam) {
    btnAddourteam.onclick = (e) => {
      e.preventDefault();
      let ourteamItemNode = new DOMParser()
        .parseFromString(ourteamItem, "text/html")
        .querySelector(".ourteam");
      ourteamGroup.appendChild(ourteamItemNode);
      let chooseImages = document.querySelectorAll(".choose-image");
      if (chooseImages) {
        chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
      }
      handleBtnDelete(ourteamGroup, "delete-ourteam", "ourteam");
    };
  }
  handleBtnDelete(ourteamGroup, "delete-ourteam", "ourteam");
}
