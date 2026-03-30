from word_choice import read_words_file, choose_random_word
from validate_guess import get_valid_guess
from wordle import check_guess_correct, feed_back_word
from display import game_instructions, game_start_display, display_word_feedback, display_win, display_lost

def main():
    # Game setup
    game_instructions()
    game_start_display()
    
    all_words = read_words_file()
    word = choose_random_word(all_words)
    attempt = 0
    max_attempts = 6
    previous_guesses = []

    while attempt < max_attempts:
        print(f"\nAttempt {attempt + 1} of {max_attempts}")
        guess = get_valid_guess(all_words, previous_guesses)
        previous_guesses.append(guess)
        
        if check_guess_correct(word, guess):
            display_win(word, attempt + 1)
            break
        
        feedback = feed_back_word(word, guess)
        print(display_word_feedback(guess, feedback))
        attempt += 1
    else:
        display_lost(word)

if __name__ == "__main__":
    main()
