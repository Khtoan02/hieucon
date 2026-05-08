import os
import glob

files = glob.glob('*.php')
for f in files:
    with open(f, 'r', encoding='utf-8') as file:
        content = file.read()
        print(f"--- {f} ---")
        # Print last 10 lines
        lines = content.strip().split('\n')
        print('\n'.join(lines[-10:]))
