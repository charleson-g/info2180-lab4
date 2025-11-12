<?php
// Set Content Type for AJAX response
header('Content-Type: text/html; charset=utf-8');

$superheroes = [
  [
      "id" => 1,
      "name" => "Steve Rogers",
      "alias" => "Captain America",
      "biography" => "Recipient of the Super-Soldier serum, World War II hero Steve Rogers fights for American ideals as one of the world’s mightiest heroes and the leader of the Avengers.",
  ],
  [
      "id" => 2,
      "name" => "Tony Stark",
      "alias" => "Ironman",
      "biography" => "Genius. Billionaire. Playboy. Philanthropist. Tony Stark's confidence is only matched by his high-flying abilities as the hero called Iron Man.",
  ],
  [
      "id" => 3,
      "name" => "Peter Parker",
      "alias" => "Spiderman",
      "biography" => "Bitten by a radioactive spider, Peter Parker’s arachnid abilities give him amazing powers he uses to help others, while his personal life continues to offer plenty of obstacles.",
  ],
  [
      "id" => 4,
      "name" => "Carol Danvers",
      "alias" => "Captain Marvel",
      "biography" => "Carol Danvers becomes one of the universe's most powerful heroes when Earth is caught in the middle of a galactic war between two alien races.",
  ],
  [
      "id" => 5,
      "name" => "Natasha Romanov",
      "alias" => "Black Widow",
      "biography" => "Despite super spy Natasha Romanoff’s checkered past, she’s become one of S.H.I.E.L.D.’s most deadly assassins and a frequent member of the Avengers.",
  ],
  [
      "id" => 6,
      "name" => "Bruce Banner",
      "alias" => "Hulk",
      "biography" => "Dr. Bruce Banner lives a life caught between the soft-spoken scientist he’s always been and the uncontrollable green monster powered by his rage.",
  ],
  [
      "id" => 7,
      "name" => "Clint Barton",
      "alias" => "Hawkeye",
      "biography" => "A master marksman and longtime friend of Black Widow, Clint Barton serves as the Avengers’ amazing archer.",
  ],
  [
      "id" => 8,
      "name" => "T'challa",
      "alias" => "Black Panther",
      "biography" => "T’Challa is the king of the secretive and highly advanced African nation of Wakanda - as well as the powerful warrior known as the Black Panther.",
  ],
  [
      "id" => 9,
      "name" => "Thor Odinson",
      "alias" => "Thor",
      "biography" => "The son of Odin uses his mighty abilities as the God of Thunder to protect his home Asgard and planet Earth alike.",
  ],
  [
      "id" => 10,
      "name" => "Wanda Maximoff",
      "alias" => "Scarlett Witch",
      "biography" => "Notably powerful, Wanda Maximoff has fought both against and with the Avengers, attempting to hone her abilities and do what she believes is right to help the world.",
  ], 
];

// 1. Sanitize user input from the 'query' parameter 
$raw_query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Trim whitespace from the query for accurate checking
$query = trim($raw_query);

$results = [];

if (empty($query)) {
    // Case 1: Query is blank, return the full list of superheroes .
    $results = $superheroes;

} else {
    // Case 2: Query is present, search for matches in 'name' or 'alias'.
    $search_term = strtolower($query);

    // Filter the array of superheroes [11]
    foreach ($superheroes as $hero) {
        // Use str_contains for substring matching (case-insensitive due to strtolower)
        $alias_match = str_contains(strtolower($hero['alias']), $search_term);
        $name_match = str_contains(strtolower($hero['name']), $search_term);

        if ($alias_match || $name_match) {
            $results[] = $hero;
        }
    }
}

// Format and output the results based on the number of matches

if (empty($results)) {
    // Case A: No superhero found
    echo '<div class="error-message">SUPERHERO NOT FOUND</div>';

} elseif (count($results) == 1 && !empty($query)) {
    // Case B: Exactly one superhero found. Output detailed view.
    $hero = $results[0]; 

    
    // Alias in <h3> tag 
    echo "<h3>" . htmlentities($hero['alias']) . "</h3>";       
    
    // Name in <h4> tag [2]
    echo "<h4>" . htmlentities($hero['name']) . "</h4>";        
    
    // Biography in <p> tag [2]
    echo "<p>" . htmlentities($hero['biography']) . "</p>";     
    
} else {
    // Case C: Multiple superheroes found, or all superheroes returned if query was blank 
    
    // Display the list of aliases
    echo "<ul>";
    foreach ($results as $hero) {
        // Outputting the alias list
        echo "<li>" . htmlentities($hero['alias']) . "</li>";
    }
    echo "</ul>";
}
?>