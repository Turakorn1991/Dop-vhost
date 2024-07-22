
function showloadersc(status,title,text)
{
  Swal.fire({
    type: status,
    title: title,
    html:"<img src='"+base_url+"/assets/images/loading.gif'/>",
    showConfirmButton:false,
    allowOutsideClick:false
  })
}

function closeloadswal()
{
  swal.close();
}