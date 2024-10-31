import Dropzone from 'dropzone'; // npm resolves this correctly
import Sortable from 'sortablejs';
Dropzone.autoDiscover = false; // Disable auto-discover if necessary
require('./bootstrap');
require('alpinejs');

$(document).ready(function() {

    function setEventListenersOnCTAs () {
        let photosSlots = document.querySelectorAll(".photo-slot");
        photosSlots.forEach(e => 
            e.addEventListener('mouseenter', function(e) {
                e.target.querySelector('.delete-photo').style.display = "block";
                e.target.querySelector('.cover-album').style.display = "block";
                e.target.querySelector('.cover-site').style.display = "block";
            }));
        photosSlots.forEach(e => 
            e.addEventListener('mouseleave', function(e) {
                e.target.querySelector('.delete-photo').style.display = "none";
                e.target.querySelector('.cover-album').style.display = "none";
                e.target.querySelector('.cover-site').style.display = "none";
        }));
        setTrashButtonsEventListeners();
        setAlbumCoverButtonEventListeners();
        setSiteCoverButtonEventListeners();
    }

    setEventListenersOnCTAs();

    function setTrashButtonsEventListeners(){
        let trashButtons = document.querySelectorAll('.delete-photo');
        trashButtons.forEach(button => {
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


    if (document.getElementById("business-photo-upload")) {
        const businessDropzone = new Dropzone("#business-photo-upload", {
            url: document.getElementById('business-photo-upload').action, // Your upload endpoint
            addRemoveLinks: true,
            init: function () {
                this.on("success", function (file, response) {
                    // Save file ID from the server response (if available)
                    let imgElement = `
                        <div class="photo-slot" data-filename="${response.success}">
                            <img src="/storage/business-photos/${response.success}" class="list-photo" alt="Saved Photo" data-order=null >
                            <div class="delete-photo" data-filename="${response.success}" style="display: none;" data-action='admin/business-photo/delete'><i class="fa fa-trash" aria-hidden="true"></i></div>
                        </div>
                    `;
                    document.getElementById('business-photo-container').insertAdjacentHTML('beforeend', imgElement);
                    setEventListenersOnCTAs();
                    file.serverId = response.fileId; // Assuming the server responds with fileId
                });
            }
        });
    };

    if (document.getElementById("business-photo-container")) {
        var businessSortable = new Sortable(document.getElementById('business-photo-container'), {
            animation: 150,
            onEnd: function (evt) {
                // Get order of photos
                let order = [];
                document.querySelectorAll('.list-photo').forEach(photo => {
                    console.log(photo.getAttribute('data-id'));
                    order.push(photo.getAttribute('data-id'));
                });
                console.log(order);
                // Save order to server
                document.getElementById('saveOrder').addEventListener('click', function () {
                    axios.post('/admin/business/save-order', {
                        photoOrder: order,
                    }).then(function (response) {
                        alert('Photos saved successfully!');
                    }).catch(function (error) {
                        console.error(error);
                    });
                });
            }
        });
    };

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
                // Get order of photos
                let order = [];
                document.querySelectorAll('.list-photo').forEach(photo => {
                    order.push(photo.getAttribute('data-id'));
                });
                console.log(order);
                // Save order to server
                document.getElementById('saveOrder').addEventListener('click', function () {
                    axios.post('/admin/photo/save-order', {
                        photoOrder: order,
                    }).then(function (response) {
                        alert('Photos saved successfully!');
                    }).catch(function (error) {
                        console.error(error);
                    });
                });
            }
        });
    }
    
});