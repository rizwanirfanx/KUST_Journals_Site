// ================ active page ================= 
// Initialize the current page index
let currentPageIndex = 0;
const pages = document.querySelectorAll(".page-content");
const icons = document.querySelectorAll(".active-icon");
const addedKeywordsContainer = document.getElementById("added-keywords");
let addedKeywords = [];

function showPage(index) {
    pages.forEach((page, i) => {
        page.style.display = i === index ? "block" : "none";
    });
    currentPageIndex = index;

    // Highlight the active icon by adding the 'active' class
    icons.forEach((icon, i) => {
        icon.classList.toggle("active", i === index);
    });
}

function togglePage(pageName) {
    const index = Array.from(pages).findIndex(page => page.id === pageName);
    if (index !== -1) {
        showPage(index);
    }
}
// //    ================ next and previous page functions
function nextPage() {
    if (currentPageIndex < pages.length - 1) {
        showPage(currentPageIndex + 1);
    }
}

function prevPage() {
    if (currentPageIndex > 0) {
        showPage(currentPageIndex - 1);
    }
}

//    ====================== adding a keyword funtion
function updateKeywords(keywordText) {
    const keywords = keywordText.trim().split(/\s+/);
    addedKeywords = keywords.slice(0, 20); // Limit to 20 keywords
    if (keywordText.trim().length === 0)
        addedKeywords = [];
    displayAddedKeywords();
    updateKeywordCount();
}

function displayAddedKeywords() {
    addedKeywordsContainer.innerHTML = "";
    addedKeywords.forEach(keyword => {
        const keywordElement = document.createElement("div");
        keywordElement.textContent = keyword;
        addedKeywordsContainer.appendChild(keywordElement);
    });
}

function updateKeywordCount() {
    const keywordCountElement = document.getElementById("keyword-count");
    const remainingKeywords = 20 - addedKeywords.length;
    keywordCountElement.textContent = `You have selected ${addedKeywords.length} keywords`;
    keywordCountElement.style.color = remainingKeywords === 0 ? "red" : "black";
}

showPage(0); // Show the first page by default

// ================ text input field word count ============
const wordLimits = {
    'text-input1': 10,
    'text-input2': 100
};

function countWords(inputId, text) {
    // Trim leading and trailing spaces
    text = text.trim();

    // Split the text by spaces and count the number of words
    const wordCount = text === "" ? 0 : text.split(/\s+/).length;

    // Display the word count
    const wordCountElement = document.getElementById('word-count' + inputId.slice(-1));
    wordCountElement.textContent = `${wordCount}/ ${wordLimits[inputId]} words`;

    // Check if the word count exceeds the word limit and truncate the input
    if (wordCount > wordLimits[inputId]) {
        const words = text.split(/\s+/);
        words.splice(wordLimits[inputId]);
        document.getElementById(inputId).value = words.join(' ');
    }
}

// ==========================  corressponding author ==================
// let authorCount = 1;

// function addAnotherAuthor() {
//     const authorForm = document.getElementById("author-form");
//     const authorFields = `
//         <div class="form-field">
//             <label for="author-name-${authorCount}">Author Name:</label>
//             <input type="text" id="author-name-${authorCount}" name="author-name-${authorCount}" required>
//         </div>
//         <div class="form-field">
//             <label for="corresponding-author-${authorCount}">Corresponding Author:</label>
//             <input type="checkbox" id="corresponding-author-${authorCount}" name="corresponding-author-${authorCount}">
//             <label for="corresponding-author-${authorCount}">Yes</label>
//         </div>
//         <div class="form-field">
//             <label for="author-details-${authorCount}">Complete Details:</label>
//             <textarea id="author-details-${authorCount}" name="author-details-${authorCount}" rows="4"></textarea>
//         </div>
//     `;

//     authorCount++;
//     authorForm.insertAdjacentHTML("beforeend", authorFields);
// }


// ================= Preview Page===================
// Data object to store user inputs
const formData = {
    "manuscript-title": "",
    "abstract": "",
    "keywords": [],
    "authors": [],
    "file": ""
};

var authors = [];

// Function to update the data object with user inputs from each page
function updateFormData() {
    // Page 1: Manuscript Details
    formData["manuscript-title"] = document.getElementById("text-input1").value;
    formData["abstract"] = document.getElementById("text-input2").value;

    // Page 2: Keywords
    formData["keywords"] = addedKeywords;

    // Page 3: Authors
    formData["authors"] = authors;
}

function renderPreviewAuthors() {
    var html = "";
    for (item of authors) {
        html += `<tr>
            <td class="col-4">${item.name}</td>
            <td class="col-8">${item.email}</td>
        </tr>`;
    }
    $("#preview-authors").html(html);
}

// Function to display the collected data on the Preview page with "Edit" option
function displayPreview() {
    $("#preview-title").text(formData['manuscript-title']);
    $("#preview-abstract").text(formData['abstract']);
    $("#preview-keywords").text(formData['keywords']);
    $("#preview-file").text(formData['file']);
    renderPreviewAuthors();
    // const previewContent = document.getElementById("preview-content");
    // previewContent.innerHTML = "";

    // // Display Manuscript Details with "Edit" link
    // const manuscriptDiv = createFieldDiv("Manuscript Title", formData["manuscript-title"]);
    // addEditLink(manuscriptDiv, 0); // 0 indicates the index of the Manuscript Details section
    // previewContent.appendChild(manuscriptDiv);

    // const abstractDiv = createFieldDiv("Abstract", formData["abstract"]);
    // addEditLink(abstractDiv, 1); // 1 indicates the index of the Abstract section
    // previewContent.appendChild(abstractDiv);

    // // Display Keywords
    // const keywordsDiv = createFieldDiv("Keywords", formData["keywords"].join(", "));
    // addEditLink(keywordsDiv, 2); // 2 indicates the index of the Keywords section
    // previewContent.appendChild(keywordsDiv);

    // // Display Authors
    // const authorsDiv = document.createElement("div");
    // authorsDiv.innerHTML = "<h3>Authors</h3>";
    // formData["authors"].forEach((authorData, index) => {
    //     const authorInfo = document.createElement("div");
    //     authorInfo.innerHTML = `
    //         <p>Author ${index + 1}</p>
    //         <p>Name: ${authorData.name}</p>
    //         <p>Corresponding Author: ${authorData.corresponding ? "Yes" : "No"}</p>
    //         <p>Complete Details: ${authorData.details}</p>
    //     `;
    //     authorsDiv.appendChild(authorInfo);
    // });
    // addEditLink(authorsDiv, 3); // 3 indicates the index of the Authors section
    // previewContent.appendChild(authorsDiv);
}

// Function to create a field div for each section on the Preview page
function createFieldDiv(fieldName, fieldValue) {
    const fieldDiv = document.createElement("div");
    fieldDiv.classList.add("field");
    fieldDiv.innerHTML = `
            <p>${fieldName}: ${fieldValue}</p>
        `;
    return fieldDiv;
}

// Function to add "Edit" link to the Preview content
function addEditLink(container, sectionIndex) {
    const editLink = document.createElement("a");
    editLink.href = "#";
    editLink.textContent = "Edit";
    editLink.onclick = function () {
        showPage(sectionIndex);
    };
    container.appendChild(editLink);
}
// Function to go back to the previous page and update the Preview content
function prevPage() {
    updateFormData();
    if (currentPageIndex > 0) {
        showPage(currentPageIndex - 1);
        if (currentPageIndex === pages.length - 1) {
            // If going back to the Preview page, display the collected data
            displayPreview();
        }
    }
}

function isValidPage(index) {
    if (index === 0) {
        if (!formData["manuscript-title"]) return false;
        if (!formData["abstract"]) return false;
        if (!formData["file"]) return false;
    }
    if (index === 1) {
        if (!formData["keywords"].length) return false;
    }
    if (index === 2) {
        if (!formData["authors"].length) return false;
    }
    return true;
}

function isValidNext() {
    console.log(isValidPage(currentPageIndex));
    for (var i = 0; i <= currentPageIndex; i++) {
        if (!isValidPage(i)) return false;
    }
    return true;
}

// Function to go to the next page and update the Preview content
function nextPage() {
    updateFormData();
    if (!isValidNext()) return;
    if (currentPageIndex < pages.length - 1) {
        showPage(currentPageIndex + 1);
        if (currentPageIndex === pages.length - 1) {
            // If going to the Preview page, display the collected data
            displayPreview();
        }
    }
}

function submitPage() {
    var data = new FormData();

    // Append the file to the FormData object
    data.append('file', document.getElementById("customFile").files[0]);

    // Append other data to the FormData object
    data.append('title', formData["manuscript-title"]);
    data.append('abstract', formData['abstract']);
    data.append('keywords', formData['keywords'].join(" "));
    data.append('authors', JSON.stringify(formData['authors']));

    console.log(data);

    $.ajax({
        url: './../function/manuscript/manuscriptFunction.php',
        type: 'POST',
        data: data,
        processData: false, // Prevent jQuery from processing the data
        contentType: false, // Prevent jQuery from setting the content type

        success: function (response) {
            console.log(response);
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message,
                    showConfirmButton: false,
                    showCancelButton: false,
                    timer: 3000
                }).then((result) => {
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message,
                    showConfirmButton: false,
                    showCancelButton: false,
                    timer: 3000
                });
            }
        },
        error: function () {
            console.error('Form submission failed');
        }
    });
}

$('#customFile').change(function () {
    var selectedFile = $(this).prop('files')[0]; // Get the selected file
    if (selectedFile) {
        formData["file"] = selectedFile.name;
        $("#custom-file-name").text(formData['file'] + " is chosen.")
        // Perform further actions with the selected file, such as uploading or processing it
    } else {
        formData["file"] = "";
        $("#custom-file-name").text("No file chosen.")
    }
});

function renderAuthor() {
    var html = "";
    var index = 0;
    for (item of authors) {
        html += `<tr>    
                                    <td class="p-4">
                                        ${item.name}
                                    </td>
                                    <td class="p-4">
                                        ${item.email}
                                    </td>
                                    <td class="delete">
                                        <input 
                                        onclick="deleteAuthor(${index})"
                                        type="button" class="p-1 m-1 w-100 btn btn-danger btn-sm delete-btn" value="DELETE"/>
                                    </td>
                                </tr>`;
        index++;
    }
    html += `<tr>
        <td>
            <input type="text" class="p-2 m-1" name="author-name" id="author-name"
                placeholder="Input name" />
        </td>
        <td>
            <input type="email" class="p-2 m-1" name="author-email" id="author-email"
                placeholder="Input email" />
        </td>
        <td class="delete">
            <input type="button" class="p-1 m-1 w-100 btn btn-primary btn-sm add-btn"
                onclick="addAuthor()"
                value="ADD" />
        </td>
    </tr>`;
    $("#table-body").html(html);
}

function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

function addAuthor() {
    if (!$("#author-name").val() || !validateEmail($("#author-email").val()))
        return;
    authors.push({
        name: $("#author-name").val(),
        email: $("#author-email").val()
    })
    renderAuthor();
}

function deleteAuthor(index) {
    authors.splice(index, 1);
    renderAuthor();
}