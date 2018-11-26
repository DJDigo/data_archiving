<div class="container">
    <?= $this->element('header'); ?>
    
    <div class="content">
        <div class="content-title">
            <h2>Search Files</h2>
        </div>
        <div class="content-wrapper">
            <!-- <ul class="search-files">
                <li class="search-list">
                    <div class="search-item">
                        <img src="../img/common/background.png" alt="images" class="search-image">
                    </div>
                    <span class="search-filename">File Name1File Name1File Name1</span>
                </li>
                <li class="search-list">
                    <div class="search-item">
                        <img src="../img/common/logo.png" alt="images" class="search-image">
                        <span class="search-filename">File Name2</span>
                    </div>
                </li>
                <li class="search-list">
                    <div class="search-item">
                        <img src="../img/common/placeholder.png" alt="images" class="search-image">
                    </div>
                    <span class="search-filename">File Name1</span>
                </li>
                <li class="search-list">
                    <div class="search-item">
                        <img src="../img/common/background.png" alt="images" class="search-image">
                        <span class="search-filename">File Name2</span>
                    </div>
                </li>
                <li class="search-list">
                    <div class="search-item">
                        <img src="../img/common/background.png" alt="images" class="search-image">
                    </div>
                    <span class="search-filename">File Name1</span>
                </li>
                <li class="search-list">
                    <div class="search-item">
                        <img src="../img/common/background.png" alt="images" class="search-image">
                        <span class="search-filename">File Name2</span>
                    </div>
                </li>
                <li class="search-list">
                    <div class="search-item">
                        <img src="../img/common/background.png" alt="images" class="search-image">
                    </div>
                    <span class="search-filename">File Name1</span>
                </li>
                <li class="search-list">
                    <div class="search-item">
                        <img src="../img/common/background.png" alt="images" class="search-image">
                        <span class="search-filename">File Name2</span>
                    </div>
                </li>
                <li class="search-list">
                    <div class="search-item">
                        <img src="../img/common/background.png" alt="images" class="search-image">
                    </div>
                    <span class="search-filename">File Name1</span>
                </li>
                <li class="search-list">
                    <div class="search-item">
                        <img src="../img/common/background.png" alt="images" class="search-image">
                        <span class="search-filename">File Name2</span>
                    </div>
                </li>
                <li class="search-list">
                    <div class="search-item">
                        <img src="../img/common/background.png" alt="images" class="search-image">
                    </div>
                    <span class="search-filename">File Name1</span>
                </li>
                <li class="search-list">
                    <div class="search-item">
                        <img src="../img/common/background.png" alt="images" class="search-image">
                        <span class="search-filename">File Name2</span>
                    </div>
                </li>
                <li class="search-list">
                    <div class="search-item">
                        <img src="../img/common/background.png" alt="images" class="search-image">
                    </div>
                    <span class="search-filename">File Name1</span>
                </li>
                <li class="search-list">
                    <div class="search-item">
                        <img src="../img/common/background.png" alt="images" class="search-image">
                        <span class="search-filename">File Name2</span>
                    </div>
                </li>
                <li class="search-list">
                    <div class="search-item">
                        <img src="../img/common/background.png" alt="images" class="search-image">
                    </div>
                    <span class="search-filename">File Name1</span>
                </li>
                <li class="search-list">
                    <div class="search-item">
                        <img src="../img/common/background.png" alt="images" class="search-image">
                        <span class="search-filename">File Name2</span>
                    </div>
                </li>
            </ul>
            <div class="pagination">
                <ul>
                    <li class="pagination-list">
                        <a href="" class="pagination-item"><</a>
                    </li>
                    <li class="pagination-list">
                        <a href="" class="pagination-item pagination-item--active">1</a>
                    </li>
                    <li class="pagination-list">
                        <a href="" class="pagination-item">2</a>
                    </li>
                    <li class="pagination-list">
                        <a href="" class="pagination-item">3</a>
                    </li>
                    <li class="pagination-list">
                        <a href="" class="pagination-item">></a>
                    </li>
                </ul>
            </div> -->
            <div class="file-list">
                <table id="file-list" class="table table-bordered stripe">
                    <thead>
                        <tr>
                            <td>File Name</td>
                            <td>Category</td>
                            <td>Date</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>File1.jpg</td>
                            <td>Main Folder1</td>
                            <td>2018-08-30</td>
                            <td>
                                <div class="button-view-wrapper">
                                    <button class="button-view">View</button>
                                </div>
                                <div class="button-delete-wrapper">
                                    <button class="button-delete">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>File1.jpg</td>
                            <td>Main Folder2</td>
                            <td>2018-08-30</td>
                            <td>
                                <div class="button-view-wrapper">
                                    <button class="button-view">View</button>
                                </div>
                                <div class="button-delete-wrapper">
                                    <button class="button-delete">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>File1.jpg</td>
                            <td>Main Folder3</td>
                            <td>2018-08-30</td>
                            <td>
                                <div class="button-view-wrapper">
                                    <button class="button-view">View</button>
                                </div>
                                <div class="button-delete-wrapper">
                                    <button class="button-delete">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>File1.jpg</td>
                            <td>Main Folder4</td>
                            <td>2018-08-30</td>
                            <td>
                                <div class="button-view-wrapper">
                                    <button class="button-view">View</button>
                                </div>
                                <div class="button-delete-wrapper">
                                    <button class="button-delete">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="showModal">
    <div class="modal-container">
        <div class="modal-image-wrapper">
            <img src="../img/common/logo.png" alt="image" class="modal-image"/>
        </div>
        <div class="modal-image-content">
            <ul>
                <li class="modal-content-list">
                    <label class="modal-content-label">File Name:</label>
                    <div class="modal-content-info">
                        <span>Menandro_oba_san.jpg</span>
                    </div>
                </li>
                <li class="modal-content-list">
                    <label class="modal-content-label">Date:</label>
                    <div class="modal-content-info">
                        <span>2018-08-30</span>
                    </div>
                </li>
                <li class="modal-content-list">
                    <label class="modal-content-label">Control No:</label>
                    <div class="modal-content-info">
                        <span>1232</span>
                    </div>
                </li>
                <li class="modal-content-list">
                    <label class="modal-content-label">Description:</label>
                    <div class="modal-content-info">
                        <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minima, vero aliquam quia, tempora id quis facilis corrupti eligendi tempore recusandae est dolorum, illo voluptate fugiat similique vitae! Aliquid, maxime corporis?</span>
                    </div>
                </li>
                <li class="modal-content-list">
                    <label class="modal-content-label">Category:</label>
                    <div class="modal-content-info">
                        <span>category2</span>
                    </div>
                </li>
            </ul>
            <div class="modal-button-wrapper">
                <button class="button-close">Close</button>
                <button class="button-print">Print</button>
            </div>
        </div>
    </div>
</div>

<script>
// Datatable
    $('#file-list').dataTable({
        "lengthMenu": [ 10, 50, 100 ],
        "lengthChange": true,
        "searching": false,
        "info": true,
        "iDisplayLength":10,
        'pagingType': 'full_numbers',
    });

</script>