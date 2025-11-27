import Dropzone from 'dropzone'; // npm resolves this correctly
import Sortable from 'sortablejs';
Dropzone.autoDiscover = false; // Disable auto-discover if necessary
require('./bootstrap');
require('alpinejs');

$(document).ready(function() {

    // Create tooltip element
    const tooltip = document.createElement('div');
    tooltip.id = 'photo-action-tooltip';
    tooltip.style.cssText = `
        position: fixed;
        background: rgba(0, 0, 0, 0.85);
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 12px;
        pointer-events: none;
        z-index: 10000;
        display: none;
        max-width: 200px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    `;
    document.body.appendChild(tooltip);

    let tooltipTimeout = null;

    function showTooltip(text, x, y) {
        clearTimeout(tooltipTimeout);
        tooltipTimeout = setTimeout(() => {
            tooltip.textContent = text;
            tooltip.style.display = 'block';
            tooltip.style.left = (x + 15) + 'px';
            tooltip.style.top = (y + 15) + 'px';
        }, 1500); // Show after 1.5 seconds
    }

    function hideTooltip() {
        clearTimeout(tooltipTimeout);
        tooltip.style.display = 'none';
    }

    function setEventListenersOnCTAs () {
        let photosSlots = document.querySelectorAll(".photo-slot");
        photosSlots.forEach(e => 
            e.addEventListener('mouseenter', function(e) {
                const deleteBtn = e.target.querySelector('.delete-photo');
                const coverAlbumBtn = e.target.querySelector('.cover-album');
                const coverSiteBtn = e.target.querySelector('.cover-site');
                const hidePhotoBtn = e.target.querySelector('.hide-photo');
                
                if (deleteBtn) deleteBtn.style.display = "block";
                if (coverAlbumBtn) coverAlbumBtn.style.display = "block";
                if (coverSiteBtn) coverSiteBtn.style.display = "block";
                if (hidePhotoBtn) hidePhotoBtn.style.display = "block";
            }));
        photosSlots.forEach(e => 
            e.addEventListener('mouseleave', function(e) {
                const deleteBtn = e.target.querySelector('.delete-photo');
                const coverAlbumBtn = e.target.querySelector('.cover-album');
                const coverSiteBtn = e.target.querySelector('.cover-site');
                const hidePhotoBtn = e.target.querySelector('.hide-photo');
                
                if (deleteBtn) deleteBtn.style.display = "none";
                if (coverAlbumBtn) coverAlbumBtn.style.display = "none";
                if (coverSiteBtn) coverSiteBtn.style.display = "none";
                if (hidePhotoBtn) hidePhotoBtn.style.display = "none";
        }));
        setTrashButtonsEventListeners();
        setAlbumCoverButtonEventListeners();
        setSiteCoverButtonEventListeners();
        setHidePhotoButtonEventListeners();
    }

    setEventListenersOnCTAs();

    function setTrashButtonsEventListeners(){
        let trashButtons = document.querySelectorAll('.delete-photo');
        trashButtons.forEach(button => {
            button.addEventListener('mouseenter', function(e) {
                showTooltip('Supprimer la photo', e.clientX, e.clientY);
            });
            button.addEventListener('mouseleave', hideTooltip);
            button.addEventListener('mousemove', function(e) {
                if (tooltip.style.display === 'block') {
                    tooltip.style.left = (e.clientX + 15) + 'px';
                    tooltip.style.top = (e.clientY + 15) + 'px';
                }
            });
            button.addEventListener('click', async function() {
            // Get the filename from data-filename attribute
                const filename = this.getAttribute('data-filename');
                const action = this.getAttribute('data-action');
                console.log('delete route', action);
                if (confirm('are you sure ?')) {
                    try {
                        const response = await fetch('../../' + action, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ filename: filename })
                        });
                        if (response.ok) {
                            const pictureSlot = document.querySelector('.photo-slot[data-filename="' + filename + '"]');
                            console.log('.photo-slot[data-filename="' + filename + '"]');
                            pictureSlot.remove();
                            const result = await response.json();
                        } else {
                            alert('Error: ' + response.statusText);
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                }
            })
        });
    }

    function setAlbumCoverButtonEventListeners() {
        let coverAlbumButtons = document.querySelectorAll('.cover-album');
        coverAlbumButtons.forEach(button => {
            button.addEventListener('mouseenter', function(e) {
                showTooltip('Définir comme couverture de l\'album', e.clientX, e.clientY);
            });
            button.addEventListener('mouseleave', hideTooltip);
            button.addEventListener('mousemove', function(e) {
                if (tooltip.style.display === 'block') {
                    tooltip.style.left = (e.clientX + 15) + 'px';
                    tooltip.style.top = (e.clientY + 15) + 'px';
                }
            });
            button.addEventListener('click', async function() {
            // Get the filename from data-filename attribute
                const photoId = this.getAttribute('data-photo-id');
                const albumId = this.getAttribute('data-album-id');
                if (confirm('make it the cover of the album ?')) {
                    try {
                        const response = await fetch('../../admin/photo/cover-album', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ 
                                photoId: photoId,
                                albumId: albumId,
                            })
                        });
                        if (response.ok) {
                            const result = await response.json();
                            document.querySelectorAll('.cover-album.selected').forEach(e=>{
                                e.classList.remove('selected');
                            })
                            button.classList.add('selected');
                        } else {
                            alert('Error: ' + response.statusText);
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                }
            })
        });    
    }

    function setSiteCoverButtonEventListeners() {
        let coverAlbumButtons = document.querySelectorAll('.cover-site');
        coverAlbumButtons.forEach(button => {
            button.addEventListener('mouseenter', function(e) {
                showTooltip('Définir comme image d\'accueil du site', e.clientX, e.clientY);
            });
            button.addEventListener('mouseleave', hideTooltip);
            button.addEventListener('mousemove', function(e) {
                if (tooltip.style.display === 'block') {
                    tooltip.style.left = (e.clientX + 15) + 'px';
                    tooltip.style.top = (e.clientY + 15) + 'px';
                }
            });
            button.addEventListener('click', async function() {
            // Get the filename from data-filename attribute
                const photoId = this.getAttribute('data-photo-id');
                const action = this.getAttribute('data-action');
                if (confirm('make it the welcome image ?')) {
                    try {
                        const response = await fetch('../../admin/photo/cover-site', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ photoId: photoId, })
                        });
                        if (response.ok) {
                            const result = await response.json();
                            document.querySelectorAll('.cover-site.selected').forEach(e=>{
                                e.classList.remove('selected');
                            })
                            button.classList.add('selected');
                        } else {
                            alert('Error: ' + response.statusText);
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                }
            })
        });    
    }

    function setHidePhotoButtonEventListeners () {
        let coverAlbumButtons = document.querySelectorAll('.hide-photo');
        coverAlbumButtons.forEach(button => {
            button.addEventListener('mouseenter', function(e) {
                showTooltip('Cacher la photo de l\'album', e.clientX, e.clientY);
            });
            button.addEventListener('mouseleave', hideTooltip);
            button.addEventListener('mousemove', function(e) {
                if (tooltip.style.display === 'block') {
                    tooltip.style.left = (e.clientX + 15) + 'px';
                    tooltip.style.top = (e.clientY + 15) + 'px';
                }
            });
            button.addEventListener('click', async function() {

                const photoId = this.getAttribute('data-photo-id');
                if (confirm('hide this photo from the album?')) {
                    try {
                        const response = await fetch('../../admin/photo/hide-photo', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ photoId: photoId })
                        });
                        if (response.ok) {
                            const result = await response.json();
                            document.querySelectorAll('.hide.selected').forEach(e=>{
                                e.classList.remove('selected');
                            })
                            button.classList.add('selected');
                        } else {
                            alert('Error: ' + response.statusText);
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                }
            })
        }); 
    }


    if (document.getElementById("album-photo-upload")) {
        let dropzoneForm = document.getElementById("album-photo-upload");
        const albumDropzone = new Dropzone("#album-photo-upload", {
            url: dropzoneForm.action, // Your upload endpoint
            addRemoveLinks: true,
            params: {
                album_id: dropzoneForm.dataset.albumId,
            },
            init: function () {
                this.on("success", function (file, response) {
                    console.log('response', response);

                    // Save file ID from the server response (if available)
                    let imgElement = `
                        <div class="photo-slot" data-filename="${response.filename}" data-id="${response.id}">
                            <img src="/storage/photos/${response.filename}" class="list-photo" alt="Saved Photo" data-order=null >
                            <div class="delete-photo" data-filename="${response.filename}" style="display: none;" data-action='admin/photo/delete'><i class="fa fa-trash" aria-hidden="true"></i></div>
                            <div class="couv-album"  data-album-id="${response.album_id}" data-photo-id="${response.id}" style="display: none;" data-action='admin/photo/delete'><i class="fa fa-trash" aria-hidden="true"></i></div>
                            <div class="couv-site" data-filename="${response.filename}" style="display: none;" data-action='admin/photo/delete'><i class="fa fa-trash" aria-hidden="true"></i></div>
                        </div>
                    `;
                    document.getElementById('album-photo-container').insertAdjacentHTML('beforeend', imgElement);
                    setEventListenersOnCTAs();
                    file.serverId = response.fileId; // Assuming the server responds with fileId
                });
            }
        });
    };

    if (document.getElementById("album-photo-container")) {
        var albumSortable = new Sortable(document.getElementById('album-photo-container'), {
            animation: 150,
            onEnd: function (evt) {
                // Auto-save order when user releases the photo
                const orderToSave = [];
                document.querySelectorAll('.list-photo').forEach(photo => {
                    orderToSave.push(photo.getAttribute('data-id'));
                });
                
                console.log('Saving order:', orderToSave);
                
                axios.post('/admin/photo/save-order', {
                    photoOrder: orderToSave,
                }).then(function (response) {
                    console.log('Order saved successfully');
                    // Optional: Show a subtle success indicator
                    // You could add a toast notification here if desired
                }).catch(function (error) {
                    console.error('Error saving order:', error);
                    alert('Error saving order: ' + (error.response?.data?.message || error.message));
                });
            }
        });
    }

    // Commission Photo Upload
    if (document.getElementById("commission-photo-upload")) {
        let commissionDropzoneForm = document.getElementById("commission-photo-upload");
        const commissionDropzone = new Dropzone("#commission-photo-upload", {
            url: commissionDropzoneForm.action,
            addRemoveLinks: true,
            init: function () {
                this.on("success", function (file, response) {
                    console.log('response', response);

                    let imgElement = `
                        <div class="photo-slot" data-filename="${response.filename}" data-id="${response.id}">
                            <img src="/storage/commissioned_photos/${response.filename}" class="list-photo" alt="Commissioned Photo" data-order=null data-id="${response.id}">
                            <div class="delete-photo" data-filename="${response.filename}" style="display: none;" data-action='admin/commission/delete'><i class="fa fa-trash" aria-hidden="true"></i></div>
                        </div>
                    `;
                    document.getElementById('commissioned-photo-container').insertAdjacentHTML('beforeend', imgElement);
                    setEventListenersOnCTAs();
                    file.serverId = response.id;
                });
            }
        });
    };

    // Commission Photo Container Sortable
    if (document.getElementById("commissioned-photo-container")) {
        var commissionSortable = new Sortable(document.getElementById('commissioned-photo-container'), {
            animation: 150,
            onEnd: function (evt) {
                // Get order of photos
                let order = [];
                document.querySelectorAll('#commissioned-photo-container .list-photo').forEach(photo => {
                    order.push(photo.getAttribute('data-id'));
                });
                console.log(order);
                // Save order to server
                document.getElementById('saveCommissionOrder').addEventListener('click', function () {
                    axios.post('/admin/commission/save-order', {
                        photoOrder: order,
                    }).then(function (response) {
                        alert('Commission photos saved successfully!');
                    }).catch(function (error) {
                        console.error(error);
                    });
                });
            }
        });
    }
    
});