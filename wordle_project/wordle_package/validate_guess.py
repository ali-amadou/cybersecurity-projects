"""Module for validating input guess.

    Functions:
    - check_guess_valid: Checks if a guess is a valid 5-letter word.
    - get_valid_guess: Gets a valid guess from the user.
"""

from typing import List

def check_guess_valid(guess: str) -> bool:
    """Check if the guess is a valid 5-letter word.
    
    Return: True if the guess is valid (5 letters), False otherwise.
    """
    return len(guess) == 5 and guess.isalpha() and guess.islower()

def get_valid_guess(all_words: List[str], guesses: List[str]) -> str:
    """Get a valid guess from the user.
    
    Must be:
    1. 5 letter word (lower case)
    2. not previously guessed
    3. exists in words.txt
    """
    while True:
        guess = input("Entrez votre supposition (un mot de 5 lettres) : ").strip().lower()

        # Check if guess is a valid 5-letter word
        if not check_guess_valid(guess):
            print("Le mot doit être composé de 5 lettres minuscules.")
            continue

        # Check if the guess has been made before
        if guess in guesses:
            print("Vous avez déjà deviné ce mot.")
            continue

        # Check if the guess is in the list of valid words
        if guess not in all_words:
            print("Ce mot n'existe pas dans la liste des mots valides.")
            continue

        return guess
