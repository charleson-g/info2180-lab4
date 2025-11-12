/* 
 * app.js 
 */

document.addEventListener('DOMContentLoaded', () => {
    // Get references to DOM elements using querySelector/getElementById 
    const searchButton = document.getElementById('search-btn');
    const queryInput = document.getElementById('superhero-query');
    const resultDiv = document.getElementById('result');

    // Attach event listener to the Search button 
    searchButton.addEventListener('click', async (event) => {
        event.preventDefault(); 
        
        //  Get user input a
        const userInput = queryInput.value.trim();
        
        //  Encode input to safely pass it in the URL query string 
        const encodedQuery = encodeURIComponent(userInput); 
        
        const url = userInput ? `superheroes.php?query=${encodedQuery}` : "superheroes.php";

        
        // Clear previous results and provide feedback
        resultDiv.innerHTML = '<p>Searching...</p>'; 

        //  Perform the AJAX request using Fetch 
        try {
            const response = await fetch(url);
            
            // Check for successful HTTP status (200 - OK)
            if (response.ok) {
                // Get the response data as text (HTML formatted by PHP)
                const resultHtml = await response.text(); 
                
                // Display the result directly inside the 'result' div [1, 11, 12]
                resultDiv.innerHTML = resultHtml;

            } else {
                // Handle server errors
                resultDiv.innerHTML = "<p>Error: Could not retrieve data (HTTP Status: " + response.status + ")</p>";
                console.error(`HTTP Error: ${response.status}`);
            }
        } catch (error) {
            // Handle network failure
            resultDiv.innerHTML = "<p>A network error occurred during the request.</p>";
            console.error(error);
        }
    });
});