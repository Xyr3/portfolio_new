/* =====================================================
   GLOBAL GAME STATE
===================================================== */

let coins = 0;
let xp = 0;
let level = 1;

/* =====================================================
   SCORE ELEMENTS
===================================================== */

const heroCoinScore = document.getElementById("heroCoinScore");

const navCoinScore = document.getElementById("navCoinScore");

const xpScore = document.getElementById("xpScore");

const levelScore = document.getElementById("levelScore");

const progressBar = document.getElementById("progressBar");

const progressPercent = document.getElementById("progressPercent");

/* =====================================================
   SCORE UPDATE
===================================================== */

function updateScore() {
  if (heroCoinScore) {
    heroCoinScore.textContent = coins;
  }

  if (navCoinScore) {
    navCoinScore.textContent = coins;
  }

  if (xpScore) {
    xpScore.textContent = xp;
  }

  if (levelScore) {
    levelScore.textContent = String(level).padStart(2, "0");
  }

  if (progressBar && progressPercent) {
    const needed = level * 100;

    const progress = Math.min((xp / needed) * 100, 100);

    progressBar.style.width = `${progress}%`;

    progressPercent.textContent = `${Math.floor(progress)}%`;
  }
}

/* =====================================================
   REWARD
===================================================== */

function addReward(coinAmount = 0, xpAmount = 0) {
  coins += coinAmount;

  xp += xpAmount;

  while (xp >= level * 100) {
    xp -= level * 100;

    level++;
  }

  updateScore();
}

/* =====================================================
   THEME
===================================================== */

const themeButton = document.getElementById("themeButton");

const savedTheme = localStorage.getItem("portfolioTheme");

function updateThemeIcon() {
  if (!themeButton) {
    return;
  }

  const night = document.body.classList.contains("night");

  themeButton.textContent = night ? "☀️" : "🌙";

  themeButton.title = night ? "Kembali ke mode siang" : "Aktifkan mode malam";
}

function applyTheme(theme) {
  document.body.classList.toggle("night", theme === "night");

  updateThemeIcon();
}

applyTheme(savedTheme === "night" ? "night" : "day");

if (themeButton) {
  themeButton.addEventListener("click", () => {
    const night = document.body.classList.toggle("night");

    localStorage.setItem("portfolioTheme", night ? "night" : "day");

    updateThemeIcon();
  });
}

/* =====================================================
   MOBILE MENU
===================================================== */

const menuButton = document.getElementById("menuButton");

const mobileMenu = document.getElementById("mobileMenu");

if (menuButton && mobileMenu) {
  menuButton.addEventListener("click", () => {
    const open = mobileMenu.classList.toggle("open");

    menuButton.textContent = open ? "✕" : "☰";
  });

  mobileMenu.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
      mobileMenu.classList.remove("open");

      menuButton.textContent = "☰";
    });
  });

  document.addEventListener("click", (event) => {
    if (
      !mobileMenu.contains(event.target) &&
      !menuButton.contains(event.target)
    ) {
      mobileMenu.classList.remove("open");

      menuButton.textContent = "☰";
    }
  });
}

/* =====================================================
   PROFILE IMAGE
===================================================== */

const profileImage = document.getElementById("profileImage");

const profileFallback = document.getElementById("profileFallback");

if (profileImage) {
  profileImage.addEventListener("error", () => {
    profileImage.style.display = "none";

    if (profileFallback) {
      profileFallback.style.display = "grid";
    }
  });
}

/* =====================================================
   SCROLL PROGRESS
===================================================== */

const scrollProgress = document.getElementById("scrollProgress");

function updateScrollProgress() {
  if (!scrollProgress) {
    return;
  }

  const top = window.scrollY;

  const height =
    document.documentElement.scrollHeight -
    document.documentElement.clientHeight;

  const percentage = height > 0 ? (top / height) * 100 : 0;

  scrollProgress.style.width = `${percentage}%`;
}

window.addEventListener("scroll", updateScrollProgress);

/* =====================================================
   REVEAL
===================================================== */

const revealElements = document.querySelectorAll(".reveal");

if ("IntersectionObserver" in window) {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
        }
      });
    },
    {
      threshold: 0.12,
    },
  );

  revealElements.forEach((element) => {
    observer.observe(element);
  });
} else {
  revealElements.forEach((element) => {
    element.classList.add("visible");
  });
}

/* =====================================================
   BACKGROUND COINS
===================================================== */

const floatingCoins = document.querySelectorAll(".floating-coin");

floatingCoins.forEach((coin) => {
  coin.addEventListener("click", () => {
    addReward(1, 5);

    coin.animate(
      [
        {
          transform: "scale(1)",
        },

        {
          transform: "scale(1.7)",
        },

        {
          transform: "scale(0)",
        },
      ],
      {
        duration: 500,
      },
    );

    setTimeout(() => {
      coin.style.display = "none";
    }, 450);
  });
});

/* =====================================================
   MEMORY GAME
===================================================== */

const memoryBoard = document.getElementById("memoryBoard");

const memoryMessage = document.getElementById("memoryMessage");

const memoryReset = document.getElementById("memoryReset");

if (memoryBoard) {
  const memorySymbols = [
    "🍄",
    "⭐",
    "🪙",
    "🌼",
    "❓",
    "🌈",
    "🍄",
    "⭐",
    "🪙",
    "🌼",
    "❓",
    "🌈",
  ];

  let firstCard = null;
  let secondCard = null;

  let locked = false;

  let matched = 0;

  function shuffle(array) {
    return array.sort(() => Math.random() - 0.5);
  }

  function createMemoryGame() {
    memoryBoard.innerHTML = "";

    firstCard = null;
    secondCard = null;
    locked = false;
    matched = 0;

    const deck = shuffle([...memorySymbols]);

    deck.forEach((icon) => {
      const card = document.createElement("button");

      card.type = "button";

      card.className = "memory-card";

      card.textContent = "❓";

      card.dataset.icon = icon;

      card.addEventListener("click", () => {
        openCard(card);
      });

      memoryBoard.appendChild(card);
    });

    if (memoryMessage) {
      memoryMessage.textContent = "Buka dua kartu!";
    }
  }

  function openCard(card) {
    if (
      locked ||
      card === firstCard ||
      card.classList.contains("open") ||
      card.disabled
    ) {
      return;
    }

    card.classList.add("open");

    card.textContent = card.dataset.icon;

    if (!firstCard) {
      firstCard = card;

      return;
    }

    secondCard = card;

    const match = firstCard.dataset.icon === secondCard.dataset.icon;

    if (match) {
      firstCard.classList.add("matched");

      secondCard.classList.add("matched");

      firstCard.disabled = true;

      secondCard.disabled = true;

      matched += 2;

      addReward(1, 8);

      if (memoryMessage) {
        memoryMessage.textContent = "✅ MATCH!";
      }

      firstCard = null;
      secondCard = null;

      if (matched === memorySymbols.length) {
        if (memoryMessage) {
          memoryMessage.textContent = "🎉 MEMORY CLEAR!";
        }

        addReward(5, 25);
      }
    } else {
      locked = true;

      if (memoryMessage) {
        memoryMessage.textContent = "❌ Bukan pasangan!";
      }

      setTimeout(() => {
        firstCard?.classList.remove("open");

        secondCard?.classList.remove("open");

        if (firstCard) {
          firstCard.textContent = "❓";
        }

        if (secondCard) {
          secondCard.textContent = "❓";
        }

        firstCard = null;
        secondCard = null;

        locked = false;

        if (memoryMessage) {
          memoryMessage.textContent = "Coba lagi!";
        }
      }, 700);
    }
  }

  memoryReset?.addEventListener("click", createMemoryGame);

  createMemoryGame();
}

/* =====================================================
   MAZE
===================================================== */

const maze = document.getElementById("maze");

const mazeMessage = document.getElementById("mazeMessage");

const mazeReset = document.getElementById("mazeReset");

if (maze) {
  const layouts = [
    [
      [0, 0, 1, 0, 0, 0, 0],
      [1, 0, 1, 0, 1, 1, 0],
      [0, 0, 0, 0, 1, 0, 0],
      [0, 1, 1, 1, 1, 0, 1],
      [0, 0, 0, 0, 0, 0, 1],
      [1, 1, 1, 1, 1, 0, 1],
      [0, 0, 0, 0, 0, 0, 0],
    ],

    [
      [0, 1, 0, 0, 0, 1, 0],
      [0, 1, 0, 1, 0, 1, 0],
      [0, 0, 0, 1, 0, 0, 0],
      [1, 1, 0, 1, 1, 1, 0],
      [0, 0, 0, 0, 0, 0, 0],
      [0, 1, 1, 1, 1, 1, 1],
      [0, 0, 0, 0, 0, 0, 0],
    ],

    [
      [0, 0, 0, 1, 0, 0, 0],
      [1, 1, 0, 1, 0, 1, 0],
      [0, 0, 0, 0, 0, 1, 0],
      [0, 1, 1, 1, 0, 1, 0],
      [0, 0, 0, 0, 0, 0, 0],
      [1, 0, 1, 1, 1, 1, 1],
      [0, 0, 0, 0, 0, 0, 0],
    ],
  ];

  let currentMaze = [];

  let playerX = 0;

  let playerY = 0;

  let finished = false;

  function newMaze() {
    const random = layouts[Math.floor(Math.random() * layouts.length)];

    currentMaze = random.map((row) => [...row]);

    playerX = 0;

    playerY = 0;

    finished = false;

    renderMaze();
  }

  function renderMaze() {
    maze.innerHTML = "";

    currentMaze.forEach((row, y) => {
      row.forEach((cell, x) => {
        const div = document.createElement("div");

        div.className = "maze-cell";

        if (cell === 0) {
          div.classList.add("path");
        } else {
          div.classList.add("wall");

          div.textContent = "🧱";
        }

        if (x === playerX && y === playerY) {
          div.innerHTML = `<div class="player">
                                    🍄
                                </div>`;
        }

        if (x === 6 && y === 6) {
          div.innerHTML = `<div class="goal">
                                    🏰
                                </div>`;
        }

        maze.appendChild(div);
      });
    });

    if (mazeMessage) {
      mazeMessage.textContent = "Temukan Castle!";
    }
  }

  function movePlayer(direction) {
    if (finished) {
      return;
    }

    let newX = playerX;

    let newY = playerY;

    if (direction === "up") {
      newY--;
    }

    if (direction === "down") {
      newY++;
    }

    if (direction === "left") {
      newX--;
    }

    if (direction === "right") {
      newX++;
    }

    if (newX < 0 || newX >= 7 || newY < 0 || newY >= 7) {
      if (mazeMessage) {
        mazeMessage.textContent = "🚧 Tidak bisa lewat!";
      }

      return;
    }

    if (currentMaze[newY][newX] !== 0) {
      if (mazeMessage) {
        mazeMessage.textContent = "🧱 Brick menghalangi!";
      }

      return;
    }

    playerX = newX;

    playerY = newY;

    renderMaze();

    if (playerX === 6 && playerY === 6) {
      finished = true;

      if (mazeMessage) {
        mazeMessage.textContent = "🎉 LEVEL CLEAR!";
      }

      addReward(10, 40);

      setTimeout(newMaze, 1200);
    }
  }

  document.querySelectorAll(".maze-controls button").forEach((button) => {
    button.addEventListener("click", () => {
      movePlayer(button.dataset.move);
    });
  });

  document.addEventListener("keydown", (event) => {
    const map = {
      ArrowUp: "up",

      ArrowDown: "down",

      ArrowLeft: "left",

      ArrowRight: "right",
    };

    if (map[event.key]) {
      movePlayer(map[event.key]);
    }
  });

  mazeReset?.addEventListener("click", newMaze);

  newMaze();
}

/* =====================================================
   MATH GAME
===================================================== */

const mathQuestion = document.getElementById("mathQuestion");

const mathAnswer = document.getElementById("mathAnswer");

const mathSubmit = document.getElementById("mathSubmit");

const mathMessage = document.getElementById("mathMessage");

const mathScore = document.getElementById("mathScore");

if (mathQuestion && mathAnswer && mathSubmit) {
  let answer = 0;

  let score = 0;

  function generateQuestion() {
    const a = Math.floor(Math.random() * 15) + 1;

    const b = Math.floor(Math.random() * 15) + 1;

    const operations = ["+", "-", "×"];

    const operation = operations[Math.floor(Math.random() * operations.length)];

    if (operation === "+") {
      answer = a + b;
    }

    if (operation === "-") {
      answer = a - b;
    }

    if (operation === "×") {
      answer = a * b;
    }

    mathQuestion.textContent = `${a} ${operation} ${b} = ?`;

    mathAnswer.value = "";
  }

  function checkAnswer() {
    if (mathAnswer.value.trim() === "") {
      mathMessage.textContent = "⚠️ Masukkan jawaban!";

      return;
    }

    const user = Number(mathAnswer.value);

    if (user === answer) {
      score++;

      mathScore.textContent = score;

      mathMessage.textContent = "🎉 BENAR! +3 COINS +8 XP";

      addReward(3, 8);

      setTimeout(generateQuestion, 500);
    } else {
      mathMessage.textContent = "❌ Salah. Coba lagi!";
    }
  }

  mathSubmit.addEventListener("click", checkAnswer);

  mathAnswer.addEventListener("keydown", (event) => {
    if (event.key === "Enter") {
      checkAnswer();
    }
  });

  generateQuestion();
}

/* =====================================================
   PROJECT BUTTONS
===================================================== */

document.querySelectorAll(".project-link").forEach((link) => {
  link.addEventListener("click", (event) => {
    /*
                       Untuk link dummy "#",
                       jangan lompat ke atas.
                    */

    if (link.getAttribute("href") === "#") {
      event.preventDefault();
    }

    addReward(1, 5);
  });
});

/* =====================================================
   INITIAL
===================================================== */

updateScore();
updateScrollProgress();
