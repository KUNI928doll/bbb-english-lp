<form action="./form.php" method="post" class="p-form h-adr">
  <span class="p-country-name" style="display: none;" aria-hidden="true">Japan</span>

  <dl class="p-form__list">
    <div class="p-form__item">
      <dt class="p-form__itemHead "><label for="your-company" class="p-form__label">会社名・屋号</label></dt>
      <dd class="p-form__itemBody"><input type="text" name="your_company" id="your-company" class="p-form__input" placeholder="入力してください" autocomplete="organization" required aria-required="true"></dd>
    </div>

    <div class="p-form__item">
      <dt class="p-form__itemHead "><label for="your-name" class="p-form__label is-required">氏名</label></dt>
      <dd class="p-form__itemBody"><input type="text" name="your_name" id="your-name" class="p-form__input" placeholder="入力してください" autocomplete="name" required aria-required="true"></dd>
    </div>

    <div class="p-form__item">
      <dt class="p-form__itemHead "><label for="your-kana" class="p-form__label is-required">氏名（フリガナ）</label></dt>
      <dd class="p-form__itemBody"><input type="text" name="your_kana" id="your-kana" class="p-form__input js-formKana" placeholder="入力してください" required aria-required="true"></dd>
    </div>

    <div class="p-form__item">
      <dt class="p-form__itemHead "><label for="your-email" class="p-form__label is-required">メールアドレス</label></dt>
      <dd class="p-form__itemBody"><input type="email" name="your_email" id="your-email" class="p-form__input" placeholder="入力してください" autocomplete="email" required aria-required="true" inputmode="email"></dd>
    </div>

    <div class="p-form__item">
      <dt class="p-form__itemHead">
        <label class="p-form__label" for="postal-code">郵便番号</label>
      </dt>
      <dd class="p-form__itemBody">
        <input class="p-form__input p-postal-code" id="postal-code" type="text" name="postal-code" placeholder="入力してください" autocomplete="postal-code" inputmode="numeric">
      </dd>
    </div>
    <div class="p-form__item">
      <dt class="p-form__itemHead">
        <label class="p-form__label" for="address">ご住所</label>
      </dt>
      <dd class="p-form__itemBody">
        <input class="p-form__input p-form__input--address p-region p-locality p-street-address p-extended-address" id="address" name="address" placeholder="入力してください" autocomplete="street-address">
      </dd>
    </div>
    <div class="p-form__item">
      <dt class="p-form__itemHead">
        <label class="p-form__label" for="tel">電話番号</label>
      </dt>
      <dd class="p-form__itemBody">
        <input class="p-form__input" id="tel" type="tel" name="tel" placeholder="入力してください" autocomplete="tel" inputmode="tel">
      </dd>
    </div>
    <div class="p-form__item">
      <dt class="p-form__itemHead">
        <label class="p-form__label is-required" for="your-tel">電話番号</label>
      </dt>
      <dd class="p-form__itemBody">
        <input type="text" name="your_tel" id="your-tel" class="p-form__input" placeholder="例）03-0123-4567" autocomplete="tel" inputmode="tel" required>
      </dd>
    </div>

    <div class="p-form__item">
      <dt class="p-form__itemHead "><label for="your-content" class="p-form__label is-required">お問い合わせ内容</label></dt>
      <dd class="p-form__itemBody"><textarea name="your_content" id="your-content" class="p-form__textarea p-form__input" placeholder="入力してください" required aria-required="true"></textarea></dd>
    </div>
  </dl>

  <div class="p-form__checkbox">
    <label class="p-form__checkboxLabel">
      <input type="checkbox" name="privacy-check" id="js-privacy" class="p-form__checkboxInput" required>
      <span class="p-form__checkboxText">
        <a href="" target="_blank" rel="noopener noreferrer">プライバシーポリシー</a><br class="u-hidden--pc u-hidden--tab">に同意する
      </span>
    </label>
  </div>

  <div class="p-form__footer">
    <input type="submit" value="送信する" class="p-form__submit c-btn c-btn--submit js-submit" disabled>
  </div>
</form>
