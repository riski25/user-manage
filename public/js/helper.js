function loading(){
    Swal.fire({
      title: "Please Wait !",
      html: "Loading ...", // add html attribute if you want or remove
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      },
    });
  }
