function previewtext() {
        
        const fileSurat = document.querySelector('#file_surat');
        const fileLabel = document.querySelector('.custom-file-label');
        
        
        fileLabel.textContent = fileSurat.files[0].name;
        
        
      }
      function previewImg() {
        
        const fileSurat = document.querySelector('#file_surat');
        const fileLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');
        
        fileLabel.textContent = fileSurat.files[0].name;
        
        const filepreview = new FileReader();
        
        filepreview.readAsDataURL(fileSurat.files[0]);
        filepreview.onload = function(e) {
          imgPreview.src = e.target.result;
        }
        
      }
