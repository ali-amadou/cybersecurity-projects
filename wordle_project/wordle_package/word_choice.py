"""Module for getting all words from words.txt and choosing a random word.

    Functions:
    - read_words_file: Reads all valid 5-letter words from the words.txt file.
    - choose_random_word: Chooses a random word from a list of words.
"""

from typing import List
import random

def read_words_file(file_path: str = 'words.txt') -> List[str]:
    """Read all valid 5-letter words from the file.
    
    Return: a list of 5-letter words
    """
    with open(file_path, 'r') as file:
        words = [line.strip().lower() for line in file.readlines() if len(line.strip()) == 5]
    return words

def choose_random_word(words: List[str]) -> str:
    """Choose the starting word for the game.
    
    Return: a random word from the list
    """
    return random.choice(words)
