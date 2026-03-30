"""Module for displaying colored text in the terminal for the Wordle game.

    Functions:
        - header: Prints a header in the terminal.
        - game_instructions: Prints the game instructions in the terminal.
        - game_start_display: Prints the starting message for the game.
        - display_word_feedback: Displays the colored feedback for a guess.

    Constants:
        - COLORS: A dictionary containing ANSI color codes for GREEN, YELLOW, RED, and RESET.
"""

from typing import List

# ANSI color formatting
COLORS = {
    "GREEN": "\033[32m",
    "YELLOW": "\033[33m",
    "RED": "\033[31m",
    "RESET": "\033[0m"
}

def header(text: str) -> None:
    """Print a header in the terminal."""
    print(COLORS["GREEN"] + text + COLORS["RESET"])

def game_instructions() -> None:
    """Print the game instructions in the terminal."""
    print("""
Bienvenue dans Wordle !
Essaye de deviner le mot en 6 tentatives.
Chaque lettre de ton essai sera colorée en fonction de son emplacement :
- Vert : la lettre est correcte et à la bonne position.
- Jaune : la lettre est correcte mais mal placée.
- Rouge : la lettre est incorrecte.

Bonne chance !
""")

def game_start_display() -> None:
    """Print the starting message for the game."""
    print(COLORS["GREEN"] + "Bienvenue dans le jeu Wordle ! Commençons !" + COLORS["RESET"])

def display_word_feedback(guess: str, feedback: List[str]) -> None:
    """Display the coloured feedback for a guess."""
    result = ""
    for letter, color in zip(guess, feedback):
        if color == "GREEN":
            result += COLORS["GREEN"] + letter + COLORS["RESET"]
        elif color == "YELLOW":
            result += COLORS["YELLOW"] + letter + COLORS["RESET"]
        else:
            result += COLORS["RED"] + letter + COLORS["RESET"]
    print(result)

def display_win(word: str, attempt: int) -> None:
    """Display for winning"""
    print(f"Félicitations ! Vous avez deviné le mot '{word}' en {attempt} tentatives.")

def display_lost(word: str) -> None:
    """Display for losing"""
    print(f"Dommage, vous avez perdu. Le mot était '{word}'.")
