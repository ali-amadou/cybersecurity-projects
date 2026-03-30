"""Module for the Wordle game.

    Functions:
    - check_guess_correct: Checks if a guess is correct.
    - find_all_char_positions: Finds all positions of a character in a word.
    - feed_back_word: Provides feedback on a guess compared to the word.

    Constants:
    - MAX_ATTEMPTS: The maximum number of attempts allowed in the game.
"""

from typing import List

# Max attempts of the game
MAX_ATTEMPTS = 6

def check_guess_correct(word: str, guess: str) -> bool:
    """Check the guess against the word.
    Return: True if the guess is correct, False otherwise.
    """
    return word == guess

def find_all_char_positions(word: str, char: str) -> List[int]:
    """Given a word and a character, find all the indices of that character."""
    return [i for i, c in enumerate(word) if c == char]

def feed_back_word(word: str, guess: str) -> List[str]:
    """Check the guess against the word and return the feedback.
    Return: a list with the feedback for each letter in the guess.
    """
    feedback = ["RED"] * len(guess)  # Default feedback is "RED" (incorrect letter)
    
    # First, check for correct letters in the correct position (GREEN)
    for i in range(len(guess)):
        if guess[i] == word[i]:
            feedback[i] = "GREEN"

    # Then, check for correct letters in the wrong position (YELLOW)
    for i in range(len(guess)):
        if feedback[i] == "RED" and guess[i] in word:
            # Check if the letter is in the word but not in the correct position
            positions_in_word = find_all_char_positions(word, guess[i])
            # Only mark as YELLOW if the letter hasn't already been used in the feedback
            if sum(1 for j in range(i) if guess[j] == guess[i] and feedback[j] != "RED") < len(positions_in_word):
                feedback[i] = "YELLOW"

    return feedback
