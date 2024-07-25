
<div class="max-w-screen-xl mx-auto justify-center items-center h-full flex flex-col min-h-full mt-20 px-10 ">
<?php if(isset(($model["error"]))):?>
  <div role="alert" class="alert alert-error">
  <svg
    xmlns="http://www.w3.org/2000/svg"
    class="h-6 w-6 shrink-0 stroke-current"
    fill="none"
    viewBox="0 0 24 24">
    <path
      stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="2"
      d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span> <?php echo $model["error"]?>  </span>
</div>

<?php endif?>
    <form action="/add" class="w-full max-h-screen h-full" method="POST">
        <div class="w-full max-w-screen flex flex-col">
            <div class="flex flex-col gap-2">
                <label for="title"><h1 class="text-xl">Judul Konten</h1></label>
                <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-lg" name="title" id="title" required/>
            </div>

            <div class="flex flex-col gap-2 mt-2">
                <label for="content"><h1 class="text-xl">Isi Konten</h1></label>
                <textarea class="textarea textarea-bordered" placeholder="Bio" name="content" id="content" required></textarea>
            </div>

            <div class="flex flex-row gap-2 mt-2">
                <div class="flex flex-col flex-1 gap-2">
                    <div id="select-container" class="flex flex-col mt-2 gap-2">
                        <label for="tag"><h1 class="text-xl">Tag</h1></label>
                        <select class="select select-bordered w-full" name="tag_ids[]">
                            <option disabled selected>Tags ?</option>
                            <?php foreach($model["blogTag"] as $tag): ?>
                                <option value="<?= $tag["id"] ?>"><?= $tag["name"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="button" class="btn bg-green-400 text-2xl" id="addBtn" onclick="addSelect()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
</svg>
                    </button>
                    <button type="button" class="btn bg-red-500 text-2xl" id="deleteBtn" onclick="deleteSelect()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
  <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
</svg>
                    </button>
                </div>
                <div class="flex flex-col flex-1 gap-2">
                    <div id="category-container" class="flex flex-col mt-2 gap-2 "  >
                        <label for="content"><h1 class="text-xl">Kategori Konten</h1></label>
                        <select class="select select-bordered w-full" name="category_ids[]">
                            <option disabled selected>Category ?</option>
                            <?php foreach($model["blogCategory"] as $category): ?>
                                <option value="<?= $category["id"] ?>"><?= $category["name"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="button" class="btn bg-green-400 text-2xl " onclick="addCategory()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
</svg>
                    </button>
                    <button type="button" class="btn bg-red-500 text-2xl" onclick="deleteCategory()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
  <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
</svg>
                    </button>
                </div>
            </div>
            
            <button type="submit" class="btn btn-ghost bg-neutral text-white mt-10">Tambahkan Konten</button>
        </div>
    </form>
    <div role="alert" class="alert alert-error mt-10 mb-10 hidden" id="alert">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>Cant Delete The Last Option</span>
    </div>
</div>

<script>
    let selectContainer = document.getElementById("select-container");
    let categoryContainer = document.getElementById("category-container");
    const values = <?php echo json_encode($model["blogTag"]) ?>;
    const values2 = <?php echo json_encode($model["blogCategory"]) ?>;

    function addSelect() {
        let select = document.createElement("select");
        select.classList.add("select", "select-bordered", "w-full");
        select.setAttribute("name", "tag_ids[]");
        let defaultOption = document.createElement("option");
        defaultOption.disabled = true;
        defaultOption.selected = true;
        defaultOption.textContent = "Tags ?";
        select.appendChild(defaultOption);


        values.forEach(value => {
            let option = document.createElement("option");
            option.value = value.id;
            option.textContent = value.name;
            select.appendChild(option);
        });

        selectContainer.appendChild(select);
    }

    function deleteSelect() {
        let alert = document.getElementById("alert");
        
        if (selectContainer.children.length <= 2) {
            alert.classList.remove("hidden");
        } else {
            selectContainer.removeChild(selectContainer.lastChild);
            alert.classList.add("hidden"); 
        }
    }

    function addCategory() {
        let select = document.createElement("select");
        select.classList.add("select", "select-bordered", "w-full");
        select.setAttribute("name", "category_ids[]");
        // Add default option
        let defaultOption = document.createElement("option");
        defaultOption.disabled = true;
        defaultOption.selected = true;
        defaultOption.textContent = "Category ?";
        select.appendChild(defaultOption);

        // Add options
        values2.forEach(value => {
            let option = document.createElement("option");
            option.value = value.id;
            option.textContent = value.name;
            select.appendChild(option);
        });

        categoryContainer.appendChild(select);
    }

    function deleteCategory() {
        let alert = document.getElementById("alert");
        
        if (categoryContainer.children.length <= 2) {
            alert.classList.remove("hidden");
        } else {
            categoryContainer.removeChild(categoryContainer.lastChild);
            alert.classList.add("hidden"); 
        }
    }
</script>

