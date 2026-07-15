<div class="p-form">
  <div class="p-form__inputArea js-inputArea">

    <dl class="p-form__list">
      <div class="p-form__item">
        <dt class="p-form__itemHead "><label for="your-company" class="p-form__label">会社名・屋号</label></dt>
        <dd class="p-form__itemBody">[text your_company id:your-company class:p-form__input placeholder "会社名・屋号"]</dd>
      </div>

      <div class="p-form__item">
        <dt class="p-form__itemHead "><label for="your-name" class="p-form__label is-required">氏名</label></dt>
        <dd class="p-form__itemBody">[text* your_name id:your-name class:p-form__input placeholder "氏名"]</dd>
      </div>

      <div class="p-form__item">
        <dt class="p-form__itemHead "><label for="your-kana" class="p-form__label is-required">氏名（フリガナ）</label></dt>
        <dd class="p-form__itemBody">[text* your_kana id:your-kana class:p-form__input class:js-formKana placeholder "氏名（フリガナ）"]</dd>
      </div>

      <div class="p-form__item">
        <dt class="p-form__itemHead "><label for="your-email" class="p-form__label is-required">メールアドレス</label></dt>
        <dd class="p-form__itemBody">[email* your_email id:your-email class:p-form__input placeholder "example@example.com"]</dd>
      </div>

      <div class="p-form__item">
        <dt class="p-form__itemHead "><label for="your-content" class="p-form__label is-required">お問い合わせ内容</label></dt>
        <dd class="p-form__itemBody">[textarea* your_content id:your-content class:p-form__textarea class:p-form__input]</dd>
      </div>

      <div class="p-form__item">
        <dt class="p-form__itemHead"><label for="file" class="p-form__label is-required">履歴書(ファイル添付)</label></dt>
        <dd class="p-form__itemBody">
          <button type="button" class="p-form__fileButton js-fileButton">[file* file limit:1048576 id:file class:p-form__file filetypes:jpg|jpeg|png|gif|pdf]<span class="js-fileName">ファイルを選択</span></button><span class="js-noFile">選択されていません</span>
          <p class="p-form__itemText">
            履歴書、職務経歴書、自己紹介文（任意）などを添付してください。<br>
            ※添付可能なファイル形式は、doc,docx,pdfです。<br>
            ※１ファイルのファイルサイズは最大で1MBまでです。<br>
            ※ファイル名は半角英数字でお願いします。
          </p>
        </dd>
      </div>
    </dl>



    <!-- <div class="p-form__checkbox">
      <label class="p-form__checkboxLabel"><input id="js-privacy" class="p-form__checkboxInput" type="checkbox" name="privacy-check" required><span class="p-form__checkboxText"><a href="" target="_blank" rel="noopener noreferrer">プライバシーポリシー</a><br class="u-hidden--pc u-hidden--tab">に同意する</span></label>
    </div> -->
    <div class="p-form__privacyWrap">
      <label class="p-form__checkboxLabel">[acceptance privacy-check id:js-privacy class:p-form__privacyCheck]<span class="p-form__checkboxText"><a href="/privacy" target="_blank" rel="noopener noreferrer">プライバシーポリシー</a>に同意する</span></label>
    </div>


    <div class="p-form__footer">
      <input type="button" value="内容を確認する" class="p-form__submit c-btn c-btn--submit js-confirmBtn" disabled>
    </div>
  </div>

  <div class="p-form__confirmArea js-confirmArea">

    <dl class="p-form__list">
      <div class="p-form__item">
        <dt class="p-form__itemHead p-form__itemHead--noMargin "><span class="p-form__label is-required">応募職種</span></dt>
        <dd class="p-form__itemBody"><span class="p-form__confirm js-confirm" data-input-name="kind"></span></dd>
      </div>

      <div class="p-form__item">
        <dt class="p-form__itemHead "><span class="p-form__label is-required">お名前</span></dt>
        <dd class="p-form__itemBody"><span class="p-form__confirm js-confirm" data-input-name="your_name"></span></dd>
      </div>

      <div class="p-form__item">
        <dt class="p-form__itemHead "><span class="p-form__label is-required">メールアドレス</span></dt>
        <dd class="p-form__itemBody"><span class="p-form__confirm js-confirm" data-input-name="your_email"></span></dd>
      </div>

      <div class="p-form__item">
        <dt class="p-form__itemHead "><span class="p-form__label is-required">電話番号</span></dt>
        <dd class="p-form__itemBody"><span class="p-form__confirm js-confirm" data-input-name="tel"></span></dd>
      </div>

      <div class="p-form__item">
        <dt class="p-form__itemHead "><span class="p-form__label is-required">お問い合わせ詳細</span></dt>
        <dd class="p-form__itemBody"><span class="p-form__confirm js-confirm" data-input-name="your_content"></span></dd>
      </div>

      <div class="p-form__item">
        <dt class="p-form__itemHead"><span class="p-form__label is-required">履歴書(ファイル添付)</span></dt>
        <dd class="p-form__itemBody">
          <span class="p-form__fileButton"><span class="p-form__confirm js-confirm" data-input-name="file"></span></span>
          <p class="p-form__itemText">
            履歴書、職務経歴書、自己紹介文（任意）などを添付してください。<br>
            ※添付可能なファイル形式は、doc,docx,pdfです。<br>
            ※１ファイルのファイルサイズは最大で1MBまでです。<br>
            ※ファイル名は半角英数字でお願いします。
          </p>
        </dd>
      </div>
    </dl>


    <div class="p-form__privacyWrap">
      <span class="p-form__checkboxLabel"><span class="p-form__checkboxText"><a href="/privacy" target="_blank" rel="noopener noreferrer"><span class="p-form__confirm js-confirm" data-input-name="privacy-check"></span>プライバシーポリシー</a>に同意する</span></span>
    </div>

    <div class="p-form__footer">
      <span class="p-form__submit p-form__submit--back">
        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="10" cy="10.5" r="9.5" stroke="#fff" />
          <path d="M6 10a.5.5 0 000 1v-1zm8.354.854a.5.5 0 000-.708l-3.182-3.182a.5.5 0 10-.708.708l2.829 2.828-2.829 2.828a.5.5 0 10.708.708l3.182-3.182zM6 11h8v-1H6v1z" fill="#fff" />
        </svg>
        <span>戻る</span><input type="button" value="" class="p-form__return js-backBtn">
      </span>
      <span class="p-form__submit">
        <span>送信する</span>[submit class:p-form__submit "送信する"]
        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="10" cy="10.5" r="9.5" stroke="#fff" />
          <path d="M6 10a.5.5 0 000 1v-1zm8.354.854a.5.5 0 000-.708l-3.182-3.182a.5.5 0 10-.708.708l2.829 2.828-2.829 2.828a.5.5 0 10.708.708l3.182-3.182zM6 11h8v-1H6v1z" fill="#fff" />
        </svg>
      </span>
    </div>

  </div>
</div>