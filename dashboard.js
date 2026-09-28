document.addEventListener("DOMContentLoaded", () => {
  /* =================================================
       SIDEBAR NAVIGATION
    ================================================== */

  const sideLinks = document.querySelectorAll(".side-link");

  sideLinks.forEach((link) => {
    link.addEventListener("click", () => {
      sideLinks.forEach((item) => {
        item.classList.remove("active");
      });

      link.classList.add("active");
    });
  });

  /* =================================================
       QUICK BUTTON
    ================================================== */

  document.querySelectorAll("[data-scroll]").forEach((button) => {
    button.addEventListener("click", () => {
      const target = document.querySelector(button.dataset.scroll);

      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
        });
      }
    });
  });

  /* =================================================
       PROFILE LIVE PREVIEW
    ================================================== */

  const profileName = document.getElementById("profileName");

  const profileRole = document.getElementById("profileRole");

  const miniPreviewName = document.getElementById("miniPreviewName");

  const miniPreviewRole = document.getElementById("miniPreviewRole");

  if (profileName && miniPreviewName) {
    profileName.addEventListener("input", () => {
      miniPreviewName.textContent = profileName.value || "PLAYER";
    });
  }

  if (profileRole && miniPreviewRole) {
    profileRole.addEventListener("input", () => {
      miniPreviewRole.textContent = profileRole.value || "CREATIVE DEVELOPER";
    });
  }

  /* =================================================
       SKILL BAR REALTIME
    ================================================== */

  function updateSkill(card) {
    const input = card.querySelector(".skill-percent-input");

    const bar = card.querySelector(".skill-editor-bar span");

    if (!input || !bar) {
      return;
    }

    let value = Number(input.value);

    value = Math.max(0, Math.min(100, value));

    bar.style.width = `${value}%`;
  }

  function bindSkill(card) {
    const input = card.querySelector(".skill-percent-input");

    if (input) {
      input.addEventListener("input", () => {
        updateSkill(card);
      });
    }

    const deleteButton = card.querySelector(".delete-card");

    if (deleteButton) {
      deleteButton.addEventListener("click", () => {
        removeCard(card);
      });
    }
  }

  document.querySelectorAll(".skill-editor-card").forEach(bindSkill);

  /* =================================================
       REMOVE CARD
    ================================================== */

  function removeCard(card) {
    card.style.opacity = "0";

    card.style.transform = "scale(.94)";

    setTimeout(() => {
      card.remove();
    }, 180);
  }

  /* =================================================
       ADD SKILL
    ================================================== */

  const addSkill = document.getElementById("addSkill");

  const skillsContainer = document.getElementById("skillsContainer");

  if (addSkill && skillsContainer) {
    addSkill.addEventListener("click", () => {
      const card = document.createElement("article");

      card.className = "skill-editor-card";

      card.innerHTML = `

                    <div class="skill-card-head">

                        <div class="skill-icon-edit">

                            <input
                                type="text"
                                name="skill_icon[]"
                                value="⭐"
                            >

                        </div>

                        <button
                            type="button"
                            class="delete-card"
                        >
                            ×
                        </button>

                    </div>


                    <div class="field-block compact">

                        <label>
                            SKILL NAME
                        </label>

                        <input
                            type="text"
                            name="skill_name[]"
                            value=""
                            placeholder="PHP"
                        >

                    </div>


                    <div class="skill-two-fields">

                        <div
                            class="field-block compact"
                        >

                            <label>
                                LEVEL
                            </label>

                            <input
                                type="text"
                                name="skill_level[]"
                                value="LV.01"
                            >

                        </div>


                        <div
                            class="field-block compact"
                        >

                            <label>
                                %
                            </label>

                            <input
                                type="number"
                                name="skill_percentage[]"
                                min="0"
                                max="100"
                                value="50"
                                class="skill-percent-input"
                            >

                        </div>

                    </div>


                    <div
                        class="skill-editor-bar"
                    >
                        <span
                            style="width:50%"
                        ></span>
                    </div>


                    <div
                        class="field-block compact"
                    >

                        <label>
                            DESCRIPTION
                        </label>

                        <input
                            type="text"
                            name="skill_description[]"
                            placeholder="Deskripsi skill"
                        >

                    </div>

                `;

      skillsContainer.appendChild(card);

      bindSkill(card);

      card.scrollIntoView({
        behavior: "smooth",
        block: "center",
      });
    });
  }

  /* =================================================
       ADD MISSION
    ================================================== */

  const addMission = document.getElementById("addMission");

  const missionsContainer = document.getElementById("missionsContainer");

  if (addMission && missionsContainer) {
    addMission.addEventListener("click", () => {
      const card = document.createElement("article");

      card.className = "mission-editor-card";

      card.innerHTML = `

                    <div class="mission-number">

                        <span>
                            ⭐
                        </span>

                        <small>
                            MISSION
                        </small>

                    </div>


                    <div class="mission-edit-content">

                        <div class="field-row">

                            <div
                                class="field-block"
                            >

                                <label>
                                    DATE
                                </label>

                                <input
                                    type="text"
                                    name="mission_date[]"
                                    value="2026"
                                >

                            </div>


                            <div
                                class="field-block"
                            >

                                <label>
                                    TITLE
                                </label>

                                <input
                                    type="text"
                                    name="mission_title[]"
                                    placeholder="Mission baru"
                                >

                            </div>

                        </div>


                        <div
                            class="field-block"
                        >

                            <label>
                                DESCRIPTION
                            </label>

                            <textarea
                                name="mission_description[]"
                                rows="3"
                                placeholder="Deskripsi mission"
                            ></textarea>

                        </div>


                        <div
                            class="field-block"
                        >

                            <label>
                                ICON
                            </label>

                            <input
                                type="text"
                                name="mission_icon[]"
                                value="⭐"
                            >

                        </div>

                    </div>


                    <button
                        type="button"
                        class="delete-card mission-delete"
                    >
                        ×
                    </button>

                `;

      missionsContainer.appendChild(card);

      const deleteButton = card.querySelector(".delete-card");

      deleteButton.addEventListener("click", () => {
        removeCard(card);
      });

      card.scrollIntoView({
        behavior: "smooth",
        block: "center",
      });
    });
  }

  /* =================================================
       ADD PROJECT
    ================================================== */

  const addProject = document.getElementById("addProject");

  const projectsContainer = document.getElementById("projectsContainer");

  if (addProject && projectsContainer) {
    addProject.addEventListener("click", () => {
      const card = document.createElement("article");

      card.className = "project-editor-card";

      card.innerHTML = `

                    <div class="project-cover">

                        <input
                            type="text"
                            name="project_icon[]"
                            value="🚀"
                            class="project-icon-input"
                        >

                        <span>
                            WORLD 4
                        </span>

                    </div>


                    <div class="project-edit-body">

                        <button
                            type="button"
                            class="delete-card"
                        >
                            ×
                        </button>


                        <div
                            class="field-block compact"
                        >

                            <label>
                                WORLD
                            </label>

                            <input
                                type="text"
                                name="project_world[]"
                                value="WORLD 4"
                            >

                        </div>


                        <div
                            class="field-block compact"
                        >

                            <label>
                                PROJECT NAME
                            </label>

                            <input
                                type="text"
                                name="project_title[]"
                                placeholder="Project baru"
                            >

                        </div>


                        <div
                            class="field-block compact"
                        >

                            <label>
                                DESCRIPTION
                            </label>

                            <textarea
                                name="project_description[]"
                                rows="3"
                                placeholder="Deskripsi project"
                            ></textarea>

                        </div>


                        <div
                            class="field-block compact"
                        >

                            <label>
                                PROJECT LINK
                            </label>

                            <input
                                type="url"
                                name="project_url[]"
                                placeholder="https://..."
                            >

                        </div>

                    </div>

                `;

      projectsContainer.appendChild(card);

      const deleteButton = card.querySelector(".delete-card");

      deleteButton.addEventListener("click", () => {
        removeCard(card);
      });

      card.scrollIntoView({
        behavior: "smooth",
        block: "center",
      });
    });
  }

  /* =================================================
       DELETE EXISTING CARDS
    ================================================== */

  document.querySelectorAll(".delete-card").forEach((button) => {
    if (button.dataset.bound) {
      return;
    }

    button.dataset.bound = "true";

    button.addEventListener("click", () => {
      const card = button.closest(
        ".skill-editor-card, .mission-editor-card, .project-editor-card",
      );

      if (card) {
        removeCard(card);
      }
    });
  });

  /* =================================================
       SAVE BUTTON
    ================================================== */

  const form = document.getElementById("portfolioEditor");

  const saveButton = document.getElementById("saveButton");

  if (form && saveButton) {
    form.addEventListener("submit", () => {
      saveButton.disabled = true;

      saveButton.textContent = "⭐ SAVING WORLD...";
    });
  }

  /* =================================================
       MOUSE PARALLAX
    ================================================== */

  const welcomeCard = document.querySelector(".welcome-card");

  if (welcomeCard && window.innerWidth > 900) {
    welcomeCard.addEventListener("mousemove", (event) => {
      const rect = welcomeCard.getBoundingClientRect();

      const x = (event.clientX - rect.left - rect.width / 2) / 30;

      const y = (event.clientY - rect.top - rect.height / 2) / 30;

      welcomeCard.style.transform = `rotateY(${x}deg) rotateX(${-y}deg)`;
    });

    welcomeCard.addEventListener("mouseleave", () => {
      welcomeCard.style.transform = "rotateY(0) rotateX(0)";
    });
  }
});
