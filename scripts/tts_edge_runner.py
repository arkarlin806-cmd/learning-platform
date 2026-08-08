import asyncio
import edge_tts
import sys
import os

TEXT = sys.argv[1]
VOICE = sys.argv[2]
OUTPUT = sys.argv[3]

async def main():

    folder = os.path.dirname(OUTPUT)

    if not os.path.exists(folder):
        os.makedirs(folder)

    communicate = edge_tts.Communicate(
        TEXT,
        VOICE
    )

    await communicate.save(OUTPUT)

asyncio.run(main())